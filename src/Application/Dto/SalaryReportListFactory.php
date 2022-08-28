<?php

declare(strict_types=1);

namespace App\Application\Dto;

use App\Application\Dto\Builder\SalaryReportListBuilderInterface;

final class SalaryReportListFactory
{
    public function __construct(
        private SalaryReportListBuilderInterface $builder
    ) {}

    public function create(array $employees): SalaryReportList
    {
        return $this->builder->build($employees);
    }
}