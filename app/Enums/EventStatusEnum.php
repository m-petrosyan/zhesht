<?php

namespace App\Enums;

enum EventStatusEnum: int
{
    case ACTIVE = 1;
    case CANCELLED = 2;
    case POSTPONED = 3;
}
