<?php

declare(strict_types=1);

namespace App\Infrastructure\Filters\SalaryReport;

use App\Infrastructure\Filters\AbstractFilter;
use App\Presentation\Request\InputFilterInterface;
use Doctrine\ORM\QueryBuilder;

final class FirstNameFilter extends AbstractFilter
{
    public function appendFilter(
        QueryBuilder $qb,
        InputFilterInterface $inputFilter,
        string $tableAlias
    ): void {
        $whereStatement = sprintf(
            'LOWER(%s.%s) LIKE :firstName',
            $tableAlias,
            $this->getKey()
        );

        $qb->andWhere($whereStatement)
            ->setParameter('firstName', '%'.mb_strtolower($inputFilter->getValue()).'%');
    }

    public function getKey(): string
    {
        return 'firstName';
    }
}