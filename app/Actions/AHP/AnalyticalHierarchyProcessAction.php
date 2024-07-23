<?php

namespace App\Actions\AHP;

use App\Enums\EducationLevelEnum;
use App\Models\Application;
use App\Models\Criteria;
use App\Models\Score;
use App\Models\SubCriteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AnalyticalHierarchyProcessAction
{
    public function calculateAHP(?array $filters = null): array
    {
        // Step 1: Retrieve Criteria
        $criteria = Criteria::all();
        $numCriteria = $criteria->count();

        // Step 2: Create Pairwise Comparison Matrix for Criteria
        $comparisonMatrix = $this->createPairwiseComparisonMatrix($criteria);

        // Step 3: Normalize Comparison Matrix and Calculate Priority Vector for Criteria
        $priorityVector = $this->normalizeComparisonMatrix($numCriteria, $comparisonMatrix);
        $criteriaWeights = $priorityVector;

        // Step 4: Calculate SubCriteria Weights
        $subCriteriaWeights = [];
        foreach ($criteria as $criterion) {
            $subCriteria = SubCriteria::where('criteria_id', $criterion->id)
                ->get();
            $numSubCriteria = $subCriteria->count();

            if ($numSubCriteria > 0) {
                // Create Pairwise Comparison Matrix for SubCriteria
                $subComparisonMatrix = $this->createPairwiseComparisonMatrix($subCriteria);

                // Normalize the SubCriteria Comparison Matrix
                $subPriorityVector = $this->normalizeComparisonMatrix($numSubCriteria, $subComparisonMatrix);

                $subCriteriaWeights[] = $subPriorityVector;
            } else {
                $subCriteriaWeights[] = [1];
            }
        }

        //dd($criteriaWeights, $subCriteriaWeights);

        // Step 5: Evaluate Applications
        $applications = Application::where('status', 'pending')
            ->when($filters !== null, function (Builder $query) use ($filters) {
                $query->when(isset($filters['start_date'], $filters['end_date']), function (Builder $query) use ($filters) {
                    $query->whereBetween('created_at', [$filters['start_date'].' 00:00:00', $filters['end_date'].' 23:59:59']);
                })
                    ->when(isset($filters['gender']) || $filters['gender'] !== 'all', function (Builder $query) use ($filters) {
                        $query->whereIn('gender', [$filters['gender']]);
                    });
            })
            ->get();

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

        // Step 6: Evaluation Results & Sort Score by DESC
        $evaluationResults = collect($evaluationResults)
            ->map(function ($item, $index) {
                $rand = $index / 10000;

                return [
                    'application_id' => hashIdsEncode($item['application_id']),
                    'final_score' => round($item['final_score'] + $rand, 4),
                ];
            })
            ->sortByDesc('final_score')
            ->values();

        //// Step 7: Store Final Results
        //DB::transaction(function () use ($evaluationResults) {
        //    foreach ($evaluationResults as $result) {
        //        Score::create([
        //            'application_id' => $result['application_id'],
        //            'final_score' => $result['final_score'],
        //        ]);
        //
        //        // Update application status to 'accepted'
        //        //Application::where('id', $result->application_id)->update(['status' => 'accepted']);
        //    }
        //});

        return [
            'status' => true,
            'evaluation_results' => $evaluationResults,
        ];
    }

    private function createPairwiseComparisonMatrix(Collection $collection): array
    {
        $numCriteria = $collection->count();
        $comparisonMatrix = array_fill(0, $numCriteria, array_fill(0, $numCriteria, 0));

        foreach ($collection as $i => $data1) {
            foreach ($collection as $j => $data2) {
                if ($i == $j) {
                    $comparisonMatrix[$i][$j] = 1;
                } else {
                    $comparisonMatrix[$i][$j] = $data1['weight'] / $data2['weight'];
                    $comparisonMatrix[$j][$i] = 1 / $comparisonMatrix[$i][$j];
                }
            }
        }

        return $comparisonMatrix;
    }

    private function normalizeComparisonMatrix(int $numCriteria, array $comparisonMatrix): array
    {
        /**
         * Normalize the Comparison Matrix
         */
        $columnSums = array_fill(0, $numCriteria, 0);
        for ($j = 0; $j < $numCriteria; $j++) {
            for ($i = 0; $i < $numCriteria; $i++) {
                $columnSums[$j] += $comparisonMatrix[$i][$j];
            }
        }

        $normalizedMatrix = [];
        for ($i = 0; $i < $numCriteria; $i++) {
            for ($j = 0; $j < $numCriteria; $j++) {
                $normalizedMatrix[$i][$j] = $comparisonMatrix[$i][$j] / $columnSums[$j];
            }
        }

        /**
         * Calculate the Priority Vector
         */
        $priorityVector = array_fill(0, $numCriteria, 0);
        for ($i = 0; $i < $numCriteria; $i++) {
            for ($j = 0; $j < $numCriteria; $j++) {
                $priorityVector[$i] += $normalizedMatrix[$i][$j];
            }
            $priorityVector[$i] /= $numCriteria;
        }

        return $priorityVector;
    }
}
