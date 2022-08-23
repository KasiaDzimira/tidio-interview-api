<?php

declare(strict_types=1);

namespace App\Infrastructure\Filters;

use App\Presentation\Request\InputFilterInterface;
use Doctrine\ORM\QueryBuilder;

interface FilterInterface
{
    public function getKey(): string;

    public function canHandle(InputFilterInterface $inputFilter): bool;

    public function appendFilter(QueryBuilder $qb, InputFilterInterface $inputFilter, string $tableAlias): void;
}