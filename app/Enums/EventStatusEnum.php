<?php

namespace App\Enums;

enum EventStatusEnum: int
{
    case ACTIVE = 1;
    case CANCELLED = 2;
    case POSTPONED = 3;

    public static function values(): array
    {
        return [
            self::ACTIVE,
            self::CANCELLED,
            self::POSTPONED,
        ];
    }
}


