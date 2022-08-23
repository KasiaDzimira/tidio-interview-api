<?php

declare(strict_types=1);

namespace App\Application\Query\GetSalaryReport;

use App\Enum\TimePeriod;
use App\Presentation\Request\SalaryReportFiltersCollection;
use App\Presentation\Request\SalaryReportSorting;

final class GetSalaryReportQuery
{
    public function __construct(
        private readonly TimePeriod $timePeriod,
        private readonly SalaryReportFiltersCollection $filters,
        private readonly SalaryReportSorting $sorting
    ) {}

    public function getTimePeriod(): TimePeriod
    {
        return $this->timePeriod;
    }

    public function getFilters(): SalaryReportFiltersCollection
    {
        return $this->filters;
    }

    public function getSorting(): SalaryReportSorting
    {
        return $this->sorting;
    }
}