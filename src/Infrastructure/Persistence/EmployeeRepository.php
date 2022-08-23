<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Employee;
use App\Domain\Employees;
use App\Infrastructure\Filters\FilterInterface;
use App\Infrastructure\Filters\SalaryReport\DepartmentFilter;
use App\Infrastructure\Filters\SalaryReport\FirstNameFilter;
use App\Infrastructure\Filters\SalaryReport\LastNameFilter;
use App\Presentation\Request\SalaryReportFilter;
use App\Presentation\Request\SalaryReportFiltersCollection;
use App\Presentation\Request\SalaryReportSorting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class EmployeeRepository extends ServiceEntityRepository implements Employees
{
    private const EMPLOYEE_ALIAS = 'employee';

    private array $filters;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);

        $this->filters = $this->initialiseFilters();
    }

    public function findForReport(SalaryReportFiltersCollection $filters, SalaryReportSorting $sorting): array
    {
        $qb = $this->createQueryBuilder(self::EMPLOYEE_ALIAS);
        $this->processFilters($qb, $filters->getFilters());
        $this->addSorting($qb, $sorting);

        return $qb->getQuery()->getResult();
    }

    private function processFilters(QueryBuilder $qb, array $filters)
    {
        /** @var SalaryReportFilter $inputFilter */
        foreach ($filters as $inputFilter) {
            $filter = $this->searchFilter($inputFilter);
            $filter?->appendFilter($qb, $inputFilter, self::EMPLOYEE_ALIAS);
        }
    }

    private function searchFilter(SalaryReportFilter $inputFilter): ?FilterInterface
    {
        foreach ($this->filters as $filter) {
            if ($filter->canHandle($inputFilter)) {
                return $filter;
            }
        }

        return null;
    }

    private function initialiseFilters(): array
    {
        return [
            new FirstNameFilter(),
            new LastNameFilter(),
            new DepartmentFilter(),
        ];
    }

    private function addSorting(QueryBuilder $qb, SalaryReportSorting $sorting)
    {
        $qb->orderBy(
            sprintf('%s.%s', self::EMPLOYEE_ALIAS, $sorting->getSortBy()),
            $sorting->getSortOrder()
        );
    }
}