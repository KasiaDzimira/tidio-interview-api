<?php

declare(strict_types=1);

namespace App\Application\Query\GetSalaryReport;

use App\Application\Dto\SalaryReportList;
use App\Application\Dto\SalaryReportListFactory;
use App\Domain\Employees;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetSalaryReportQueryHandler
{
    public function __construct(
        private readonly Employees $employees,
        private readonly SalaryReportListFactory $reportListFactory
    ) {}

    public function __invoke(GetSalaryReportQuery $query): SalaryReportList
    {
        $employees = $this->employees->findForReport($query->getFilters(), $query->getSorting());

        return $this->reportListFactory->create($employees);
    }
}