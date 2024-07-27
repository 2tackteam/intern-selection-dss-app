<?php

namespace App\Actions\AHP;

use App\Enums\EducationLevelEnum;
use App\Models\Application;
use App\Models\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait EvaluationWeights
{
    public function evaluation(Collection $criteria, array $criteriaWeights, array $subCriteriaWeights, ?array $filters = null): Collection
    {
        $applications = $this->fetchApplications($filters);

        $evaluationResults = [];
        foreach ($applications as $application) {
            if ($application instanceof Application) {
                $score = 0;

                foreach ($criteria as $i => $criterion) {
                    if ($criterion instanceof Criteria) {
                        $criteriaWeight = $criteriaWeights[$i];

                        $gpa = $application->education->gpa;
                        $major = $application->education->major;
                        $educationLevel = $application->education->education_level;


                        if ($criterion->name === 'Nilai / GPA') {
                            // Nilai rata-rata (GPA)
                            $gpa = $educationLevel === EducationLevelEnum::SHS_VHS->value ? $gpa : round($gpa * 100 / 4, 2);

                            $subCriterionWeight = $criterion->subCriterias()
                                ->where('min_value', '<=', $gpa)
                                ->where('max_value', '>=', $gpa)
                                ?->first()?->weight ?? 1;

                            $score += $criteriaWeight * $subCriterionWeight;
                        } elseif ($criterion->name === 'Jurusan') {
                            // Major (Jurusan)
                            $subCriterionWeight = $criterion->subCriterias()
                                ->where('name', 'like', "%$major%")
                                ?->first()?->weight ?? 1;
                            $score += $criteriaWeight * $subCriterionWeight;
                        } else {
                            // Education Level (Tingkat Pendidikan)
                            $subCriterionWeight = $criterion->subCriterias()
                                ->where('name', 'like', "%$educationLevel%")
                                ?->first()?->weight ?? 1;
                            $score += $criteriaWeight * $subCriterionWeight;
                        }
                    }
                }

                $evaluationResults[] = ['application_id' => $application->id, 'final_score' => $score];

            }
        }

        return $this->sortMap($evaluationResults);
    }

    private function fetchApplications(?array $filters = null): Collection
    {
        return Application::where('status', 'pending')
            ->when($filters !== null, function (Builder $query) use ($filters) {
                $query->when(isset($filters['start_date'], $filters['end_date']), function (Builder $query) use ($filters) {
                    $query->whereBetween('created_at', [$filters['start_date'].' 00:00:00', $filters['end_date'].' 23:59:59']);
                })
                    ->when(isset($filters['gender']) && $filters['gender'] !== 'all', function (Builder $query) use ($filters) {
                        $query->whereIn('gender', [$filters['gender']]);
                    });
            })
            ->get();
    }

    private function sortMap(array $evaluationResults): Collection
    {
        return collect($evaluationResults)
            ->map(function ($item, $index) {
                return [
                    'application_id' => hashIdsEncode($item['application_id']),
                    'final_score' => $item['final_score'],
                ];
            })
            ->sortByDesc('final_score')
            ->values();
    }
}
