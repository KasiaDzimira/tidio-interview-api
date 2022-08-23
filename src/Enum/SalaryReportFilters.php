<?php

declare(strict_types=1);

namespace App\Enum;

enum SalaryReportFilters: string
{
    case DEPARTMENT = 'department';
    case FIRST_NAME = 'firstName';
    case LAST_NAME = 'lastName';
}