<?php

namespace App\Enums;

enum EducationLevelEnum: string
{
    case SHS_VHS = 'SMA/SMK';
    case D3 = 'D3';
    case D4 = 'D4';
    case S1 = 'S1';

    public static function toArray(): array
    {
        $result = [];
        foreach (self::cases() as $case) {
            $result[] = $case->value;
        }

        return $result;
    }
}
