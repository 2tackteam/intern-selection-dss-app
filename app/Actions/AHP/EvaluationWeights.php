<?php

namespace App\Actions\AHP;

use App\Enums\EducationLevelEnum;
use App\Models\Application;
use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait EvaluationWeights
{
    public function evaluation(Collection $criteria, array $criteriaWeights, array $subCriteriaWeights, ?array $filters = null): Collection
    {
        $applications = $this->fetchApplications($filters);

        $evaluationResults = [];
        foreach ($applications as $application) {
            $score = 0;

            foreach ($criteria as $i => $criterion) {
                if ($criterion instanceof Criteria) {
                    $subCriteria = SubCriteria::where('criteria_id', $criterion->id)
                        ->orderBy('weight')
                        ->get();

                    [$relation, $attribute] = explode('.', $criterion->relation_attribute);
                    // Major, Education Level, GPA
                    $criterionValue = $application[$relation][$attribute];
                    //$major          = $application->education->major;
                    //$educationLevel = $application->education->education_level;
                    //$gpa            = $application->education->gpa;

                    $criteriaWeight = $criteriaWeights[$i];

                    if ($criterion->type === 'number') {
                        $subCriterionId = $criterion->subCriterias()
                            ->where('min_value', '<=', $criterionValue)
                            ->where('max_value', '>=', $criterionValue)
                            ?->first()?->id ?? 1;

                    } else {
                        $subCriterionId = $criterion->subCriterias()
                            ->where('name', 'like', "%$criterionValue%")
                            ?->first()?->id ?? 1;
                    }

                    $j = $this->searchIndex($subCriteria, $subCriterionId);
                    $subCriterionWeight = $subCriteriaWeights[$i][$j];

                    $score += $criteriaWeight * $subCriterionWeight;
                }
            }
            $evaluationResults[] = ['application_id' => $application['id'], 'final_score' => $score];

        }

        return $this->sortMap($evaluationResults);
    }

    private function searchIndex(Collection $collection, int $findById): int
    {
        return $collection->search(fn ($item) => $item['id'] === $findById);
    }

    private function fetchApplications(?array $filters = null): Collection
    {
        return Application::where('status', 'pending')
            ->with('education')
            ->when($filters !== null, function (Builder $query) use ($filters) {
                $query->when(isset($filters['start_date'], $filters['end_date']), function (Builder $query) use ($filters) {
                    $query->whereBetween('created_at', [$filters['start_date'].' 00:00:00', $filters['end_date'].' 23:59:59']);
                })
                    ->when(isset($filters['gender']) && $filters['gender'] !== 'all', function (Builder $query) use ($filters) {
                        $query->whereIn('gender', [$filters['gender']]);
                    });
            })
            ->get()
            ->map(fn (Application $application) => [
                ...$application->toArray(),
                'education' => [
                    ...$application->education->toArray(),
                    'gpa' => $application->education->education_level === EducationLevelEnum::SHS_VHS->value
                        ? $application->education->gpa
                        : round($application->education->gpa / 4 * 100, 2),
                ],
            ]);

    }

    private function sortMap(array $evaluationResults): Collection
    {
        return collect($evaluationResults)
            ->map(function ($item, $index) {
                return [
                    'application_id' => hashIdsEncode($item['application_id']),
                    'final_score' => round($item['final_score'], 5),
                ];
            })
            ->sortByDesc('final_score')
            ->values();
    }
}
