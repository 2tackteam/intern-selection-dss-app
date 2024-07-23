<?php

namespace App\Enums;

enum YearEnum
{
    public static function toArray(): array
    {
        $result = [];
        foreach (range(now()->year, now()->year - 100) as $year) {
            $result[] = $year;
        }

        return $result;
    }
}
