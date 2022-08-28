<?php

namespace App\Application\Dto\Builder;

use App\Application\Dto\SalaryReportList;
use App\Domain\Employee;

interface SalaryReportListBuilderInterface
{
    /**
     * @param Employee[] $employee
     */
    public function build(array $employees): SalaryReportList;
}