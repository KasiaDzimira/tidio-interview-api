<?php

declare(strict_types=1);

namespace App\Enum;

enum SalaryReportSortingFields: string
{
    case FIRST_NAME = 'firstName';
    case LAST_NAME = 'lastName';
    case DEPARTMENT = 'department';
    case BASIC_SALARY = 'basicSalary';
    case SALARY_SUPPLEMENT = 'salarySupplement';
    case SUPPLEMENT_TYPE = 'supplementType';
    case SALARY = 'salary';
}