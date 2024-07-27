<?php

namespace App\Actions\AHP;

use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Support\Collection;

class AnalyticalHierarchyProcessInstance
{
    use EvaluationResults, EvaluationWeights, NormalizeComparisonMatrix, PairwiseComparisonMatrix;

    /**
     * @throws \Throwable
     */
    public function calculateAHP(?array $filters = null): Collection
    {
        // Step 1: Retrieve Criteria
        $criteria = Criteria::query()->orderBy('weight')->get();
        $numCriteria = $criteria->count();

        // Step 2: Create Pairwise Comparison Matrix for Criteria
        $comparisonMatrix = $this->pairwiseComparisonMatrix($criteria);

        // Step 3: Normalize Comparison Matrix and Calculate Priority Vector for Criteria
        $priorityVector = $this->normalizeComparisonMatrix($numCriteria, $comparisonMatrix);
        $criteriaWeights = $priorityVector;

        // Step 4: Calculate SubCriteria Weights
        $subCriteriaWeights = [];
        foreach ($criteria as $criterion) {
            $subCriteria = SubCriteria::where('criteria_id', $criterion->id)->orderBy('weight')->get();
            $numSubCriteria = $subCriteria->count();

            if ($numSubCriteria > 0) {
                // Create Pairwise Comparison Matrix for SubCriteria
                $subComparisonMatrix = $this->pairwiseComparisonMatrix($subCriteria);

                // Normalize the SubCriteria Comparison Matrix
                $subPriorityVector = $this->normalizeComparisonMatrix($numSubCriteria, $subComparisonMatrix);

                $subCriteriaWeights[] = $subPriorityVector;
            } else {
                $subCriteriaWeights[] = [1];
            }
        }

        // Step 5: Evaluate Weights (Applications)
        $evaluationResults = $this->evaluation($criteria, $criteriaWeights, $subCriteriaWeights, $filters);

        // Step 6: Capture Final Results
        return $this->captureFinalResults($evaluationResults);
    }
}
