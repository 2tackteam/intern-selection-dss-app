<?php

namespace App\Enums;

enum ApplicationStatusEnum: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public static function toArray(): array
    {
        $result = [];
        foreach (self::cases() as $case) {
            $result[] = $case->value;
        }

        return $result;
    }
}
