<?php

declare(strict_types=1);

namespace App\Application\Dto;

class SalaryReportList
{
    public function __construct(
        private readonly array $items
    ) {}

    /**
     * @return SalaryReportItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}