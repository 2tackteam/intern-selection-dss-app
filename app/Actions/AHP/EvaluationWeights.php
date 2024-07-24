<?php

namespace App\Actions\AHP;

use App\Enums\EducationLevelEnum;
use App\Models\Application;
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
                    $criteriaWeight = $criteriaWeights[$i];

                    if ($criterion->name === 'Nilai / GPA' || $i === 0) {
                        // Nilai rata-rata (GPA)
                        $gpa = $application->education->gpa;
                        if ($gpa < 30) {
                            $score += $criteriaWeight * $subCriteriaWeights[$i][0];
                        } elseif ($gpa <= 70) {
                            $score += $criteriaWeight * $subCriteriaWeights[$i][1];
                        } else {
                            $score += $criteriaWeight * $subCriteriaWeights[$i][2];
                        }
                    } elseif ($criterion->name === 'Jurusan' || $i === 1) {
                        // Annoying Sub Criteria (Major)
                        // Major (Jurusan)
                        $score += $criteriaWeight * $subCriteriaWeights[$i][1];
                    } else {
                        // Education Level (Tingkat Pendidikan)
                        $educationLevel = $application->education->education_level;
                        if ($educationLevel === EducationLevelEnum::SHS_VHS->value) {
                            $score += $criteriaWeight * $subCriteriaWeights[$i][0];
                        } elseif ($educationLevel === EducationLevelEnum::S1->value) {
                            $score += $criteriaWeight * $subCriteriaWeights[$i][2];
                        } else {
                            $score += $criteriaWeight * $subCriteriaWeights[$i][1];
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
                    $query->whereBetween('created_at', [$filters['start_date'] . ' 00:00:00', $filters['end_date'] . ' 23:59:59']);
                })
                    ->when(isset($filters['gender']) || $filters['gender'] !== 'all', function (Builder $query) use ($filters) {
                        $query->whereIn('gender', [$filters['gender']]);
                    });
            })
            ->get();
    }

    private function sortMap(array $evaluationResults): Collection
    {
        return collect($evaluationResults)
            ->map(function ($item, $index) {
                $rand = $index / 10000;

                return [
                    'application_id' => hashIdsEncode($item['application_id']),
                    'final_score'    => round($item['final_score'] + $rand, 4),
                ];
            })
            ->sortByDesc('final_score')
            ->values();
    }
}
