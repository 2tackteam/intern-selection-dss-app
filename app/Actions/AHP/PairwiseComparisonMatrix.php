<?php

namespace App\Actions\AHP;

use Illuminate\Support\Collection;

trait PairwiseComparisonMatrix
{
    public function pairwiseComparisonMatrix(Collection $collection): array
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
}
