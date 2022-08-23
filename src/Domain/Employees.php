<?php

namespace App\Domain;

use App\Presentation\Request\SalaryReportFiltersCollection;
use App\Presentation\Request\SalaryReportSorting;

interface Employees
{
    /**
     * @return Employee[]
     */
    public function findForReport(SalaryReportFiltersCollection $filters, SalaryReportSorting $sorting): array;
}