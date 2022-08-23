<?php

declare(strict_types=1);

namespace App\Enum;

enum ListSortingRuleName: string
{
    case SORT_BY = 'sort_by';
    case SORT_ORDER = 'sort_order';
}