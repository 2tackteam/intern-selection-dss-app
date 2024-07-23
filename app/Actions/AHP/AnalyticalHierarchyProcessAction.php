<?php

namespace App\Actions\AHP;

use App\Models\Application;
use App\Models\Criteria;
use App\Models\Score;
use App\Models\SubCriteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AnalyticalHierarchyProcessAction
{
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

    public function calculateAHP(?array $filters = null): bool
    {
        // Step 1: Retrieve Criteria
        $criteria = Criteria::all();
        $numCriteria = $criteria->count();

        // Step 2: Create Pairwise Comparison Matrix for Criteria
        $comparisonMatrix = $this->createPairwiseComparisonMatrix($criteria);

        // Step 3: Normalize Comparison Matrix and Calculate Priority Vector for Criteria
        $priorityVector = $this->normalizeComparisonMatrix($numCriteria, $comparisonMatrix);


        // Step 4: Calculate SubCriteria Weights
        $subCriteriaWeights = [];
        foreach ($criteria as $criterion){
            $subCriteria = SubCriteria::where('criteria_id', $criterion->id)->get();
            $numSubCriteria = $subCriteria->count();

            if ($numSubCriteria > 0) {
                // Create Pairwise Comparison Matrix for SubCriteria
                $subComparisonMatrix = $this->createPairwiseComparisonMatrix($subCriteria);

                // Normalize the SubCriteria Comparison Matrix
                $subPriorityVector = $this->normalizeComparisonMatrix($numSubCriteria, $subComparisonMatrix);

                $subCriteriaWeights[$criterion->id] = $subPriorityVector;
            } else {
                $subCriteriaWeights[$criterion->id] = [1];
            }
        }

        // Step 5: Evaluate Applications
        $applications = Application::where('status', 'pending')
            ->when($filters !== null, function (Builder $query) use ($filters) {
                $query
                    ->when(isset($filters['start_date'], $filters['end_date']), function (Builder $query) use ($filters) {
                        $query->whereBetween('created_at', [$filters['start_date']. " 00:00:00", $filters['end_date'] . " 23:59:59"]);
                    })
                    ->when(isset($filters['gender']) || $filters['gender'] !== 'all', function (Builder $query) use ($filters) {
                        $query->whereIn('gender', [$filters['gender']]);
                    });
            })
            ->get();

        $evaluationResults = [];
        foreach ($applications as $application) {
            $score = 0;
            foreach ($criteria as $i => $criterion) {
                $criteriaWeight = $priorityVector[$i];
                $subCriteria = Subcriteria::where('criteria_id', $criterion->id)->get();
                if ($subCriteria->count() > 0) {
                    foreach ($subCriteria as $j => $sub) {
                        $subWeight = $subCriteriaWeights[$criterion->id][$j];
                        $criteriaName = $sub->name;
                        $score += $application->$criteriaName * $criteriaWeight * $subWeight;
                    }
                } else {
                    $criteriaName = $criterion->name;
                    $score += $application->$criteriaName * $criteriaWeight;
                }
            }
            $evaluationResults[] = ['application_id' => $application->id, 'score' => $score];
        }


        // Step 6: Evaluation Results
        $evaluationResults = collect($evaluationResults);


        // Step 7: Calculate Final Scores
        $finalResults = $evaluationResults->select('application_id', DB::raw('SUM(score) as final_score'))
            ->groupBy('application_id')
            ->sortDesc('final_score');


        // Step 8: Store Final Results
        return DB::transaction(function() use ($finalResults) {
            foreach ($finalResults as $result) {
                Score::create([
                    'application_id' => $result->application_id,
                    'final_score' => $result->final_score
                ]);

                // Update application status to 'accepted'
                //Application::where('id', $result->application_id)->update(['status' => 'accepted']);
            }
        });
    }
}
