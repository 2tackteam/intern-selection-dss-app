<?php

namespace App\Actions\AHP;

trait NormalizeComparisonMatrix
{
    private function normalizeMatrix(int $numCriteria, array $comparisonMatrix): array
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

        return $normalizedMatrix;
    }

    private function priorityVector(int $numCriteria, array $normalizedMatrix): array
    {
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

    protected function normalizeComparisonMatrix(int $numCriteria, array $comparisonMatrix): array
    {
        $normalizedMatrix = $this->normalizeMatrix($numCriteria, $comparisonMatrix);

        return $this->priorityVector($numCriteria, $normalizedMatrix);
    }
}
