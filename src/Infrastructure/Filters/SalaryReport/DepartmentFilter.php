<?php

declare(strict_types=1);

namespace App\Infrastructure\Filters\SalaryReport;

use App\Infrastructure\Filters\AbstractFilter;
use App\Presentation\Request\InputFilterInterface;
use Doctrine\ORM\QueryBuilder;

final class DepartmentFilter extends AbstractFilter
{
    public function appendFilter(
        QueryBuilder $qb,
        InputFilterInterface $inputFilter,
        string $tableAlias
    ): void {
        $whereStatement = sprintf(
            'LOWER(%s.%s.name) LIKE :departmentName',
            $tableAlias,
            $this->getKey()
        );

        $qb->andWhere($whereStatement)
            ->setParameter('departmentName', '%'.mb_strtolower($inputFilter->getValue()).'%');
    }

    public function getKey(): string
    {
        return 'department';
    }
}