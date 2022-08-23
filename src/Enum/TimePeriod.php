<?php

declare(strict_types=1);

namespace App\Enum;

enum TimePeriod: string
{
    case THIS_MONTH = 'THIS_MONTH';
    case LAST_QUARTER = 'LAST_QUARTER';
    case LAST_YEAR = 'LAST_YEAR';
}