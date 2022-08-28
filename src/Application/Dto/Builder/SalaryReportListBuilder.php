<?php

declare(strict_types=1);

namespace App\Application\Dto\Builder;

use App\Application\Dto\SalaryComponents;
use App\Application\Dto\SalaryReportItem;
use App\Application\Dto\SalaryReportList;
use App\Domain\Employee;
use App\Domain\Service\Salaries;

final class SalaryReportListBuilder implements SalaryReportListBuilderInterface
{
    public function __construct(
        private readonly Salaries $salaries
    ) {}

    public function build(array $employees): SalaryReportList
    {
        return new SalaryReportList(
            array_map(fn (Employee $employee) => new SalaryReportItem(
                $employee->getFirstName(),
                $employee->getLastName(),
                $employee->getDepartment()->getName(),
                $employee->getBasicSalary(),
                $employee->getDepartment()->getSalarySupplement(),
                $employee->getDepartment()->getSupplementType()->value,
                $this->salaries->calculateSalary(
                    new SalaryComponents(
                        $employee->getBasicSalary(),
                        $employee->getDepartment()->getSalarySupplement(),
                        $employee->getEmploymentYear(),
                        $employee->getDepartment()->getSupplementType()
                    )
                )
            ), $employees)
        );
    }
}