<?php

declare(strict_types=1);

namespace App\Infrastructure\Filters;

use App\Presentation\Request\InputFilterInterface;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractFilter implements FilterInterface
{
    public function canHandle(InputFilterInterface $inputFilter): bool
    {
        return $inputFilter->getKey() === $this->getKey();
    }

    abstract public function appendFilter(QueryBuilder $qb, InputFilterInterface $inputFilter, string $tableAlias): void;
}