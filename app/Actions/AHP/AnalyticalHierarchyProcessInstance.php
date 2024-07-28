<?php

namespace App\Actions\AHP;

use App\Models\Criteria;
use App\Models\SubCriteria;

class AnalyticalHierarchyProcessInstance
{
    use EvaluationResults, EvaluationWeights, NormalizeComparisonMatrix, PairwiseComparisonMatrix;

    /**
     * @throws \Throwable
     */
    public function calculateAHP(?array $filters = null): array
    {
        // Step 1: Retrieve Criteria
        $criteria = Criteria::query()->orderBy('weight')->get();
        $numCriteria = $criteria->count();

        // Step 2: Create Pairwise Comparison Matrix for Criteria
        $comparisonMatrix = $this->pairwiseComparisonMatrix($criteria);

        // Step 3: Normalize Comparison Matrix and Calculate Priority Vector for Criteria
        //$normalizeComparisonMatrix = $this->normalizeComparisonMatrix($numCriteria, $comparisonMatrix);
        $normalizedMatrix = $this->normalizedMatrix($numCriteria, $comparisonMatrix);
        $priorityVector = $this->priorityVector($numCriteria, $normalizedMatrix);
        $criteriaWeights = $priorityVector;

        // Step 4: Calculate SubCriteria Weights
        $subComparisonMatrix = [];
        $subNormalizedMatrix = [];
        $subPriorityVector = [];
        $subCriteriaWeights = [];
        foreach ($criteria as $criterion) {
            $subCriteria = SubCriteria::where('criteria_id', $criterion->id)->orderBy('weight')->get();
            $numSubCriteria = $subCriteria->count();

            if ($numSubCriteria > 0) {
                // Create Pairwise Comparison Matrix for SubCriteria
                $sub_comparisonMatrix = $this->pairwiseComparisonMatrix($subCriteria);

                // Normalize the SubCriteria Comparison Matrix
                $sub_normalizedMatrix = $this->normalizedMatrix($numSubCriteria, $sub_comparisonMatrix);
                $sub_priorityVector = $this->priorityVector($numCriteria, $sub_normalizedMatrix);

                $subComparisonMatrix[] = $sub_comparisonMatrix;
                $subNormalizedMatrix[] = $sub_normalizedMatrix;
                $subPriorityVector[] = $sub_priorityVector;

                $subCriteriaWeights[] = $sub_priorityVector;
            } else {
                $subComparisonMatrix[] = [1];
                $subNormalizedMatrix[] = [1];
                $subPriorityVector[] = [1];

                $subCriteriaWeights[] = [1];
            }
        }

        // Step 5: Evaluate Weights (Applications)
        $evaluationResults = $this->evaluation($criteria, $criteriaWeights, $subCriteriaWeights, $filters);

        // Step 6: Capture Final Results
        return [
            // Criteria
            'comparisonMatrix' => $comparisonMatrix,
            'normalizedMatrix' => $normalizedMatrix,
            'priorityVector' => $priorityVector,

            // Sub Criteria
            'subComparisonMatrix' => $subComparisonMatrix,
            'subNormalizedMatrix' => $subNormalizedMatrix,
            'subPriorityVector' => $subPriorityVector,

            // Evaluation Results
            'evaluationResults' => $this->captureFinalResults($evaluationResults),
        ];
    }
}
