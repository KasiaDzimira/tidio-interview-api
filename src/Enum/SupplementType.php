<?php

namespace App\Enum;

enum SupplementType: string
{
    case PERCENTAGE = 'PERCENTAGE';
    case FIXED_AMOUNT = 'FIXED_AMOUNT';
}