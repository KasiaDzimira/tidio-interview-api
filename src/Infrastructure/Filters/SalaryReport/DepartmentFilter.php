<?php

declare(strict_types=1);

namespace App\Infrastructure\Filters\SalaryReport;

use App\Infrastructure\Filters\AbstractFilter;
use App\Presentation\Request\InputFilterInterface;
use Doctrine\ORM\QueryBuilder;

final class DepartmentFilter extends AbstractFilter
{
    private const DEPARTMENT_ALIAS = 'department';

    public function appendFilter(
        QueryBuilder $qb,
        InputFilterInterface $inputFilter,
        string $tableAlias
    ): void {
        $whereStatement = sprintf(
            'LOWER(%s.name) LIKE :departmentName',
            self::DEPARTMENT_ALIAS
        );

        $qb
            ->leftJoin(sprintf('%s.department', $tableAlias), self::DEPARTMENT_ALIAS)
            ->andWhere($whereStatement)
            ->setParameter('departmentName', '%'.mb_strtolower($inputFilter->getValue()).'%');
    }

    public function getKey(): string
    {
        return 'department';
    }
}