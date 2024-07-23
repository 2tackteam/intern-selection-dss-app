<?php

namespace App\Enums;

enum GenderEnum: string
{
    case M = "M";
    case F = "F";

    public static function toArray(): array
    {
        $result = [];
        foreach (self::cases() as $case) {
            $result[] = $case->value;
        }

        return $result;
    }
}
