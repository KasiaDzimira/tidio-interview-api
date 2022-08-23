<?php

declare(strict_types=1);

namespace App\Application\Query\GetSalaryReport;

use App\Application\Dto\SalaryReportItem;
use App\Application\Dto\SalaryReportList;
use App\Domain\Employee;
use App\Domain\Employees;
use App\Domain\Service\Salaries;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetSalaryReportQueryHandler
{
    public function __construct(
        private readonly Employees $employees,
        private readonly Salaries $salaries
    ) {}

    public function __invoke(GetSalaryReportQuery $query): SalaryReportList
    {
        $employees = $this->employees->findForReport($query->getFilters(), $query->getSorting());

        return new SalaryReportList(
            array_map(fn (Employee $employee) => new SalaryReportItem(
                $employee->getFirstName(),
                $employee->getLastName(),
                $employee->getDepartment()->getName(),
                $employee->getBasicSalary(),
                $employee->getDepartment()->getSalarySupplement(),
                $employee->getDepartment()->getSupplementType()->value,
                $this->salaries->calculateSalary(
                    $employee->getBasicSalary(),
                    $employee->getDepartment()->getSalarySupplement(),
                    $employee->getEmploymentYear(),
                    $employee->getDepartment()->getSupplementType()
                )
            ), $employees)
        );
    }
}