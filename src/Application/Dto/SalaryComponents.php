<?php

declare(strict_types=1);

namespace App\Application\Dto;

use App\Enum\SupplementType;
use DateTimeInterface;

final class SalaryComponents
{
    public function __construct(
        private readonly float $basicSalary,
        private readonly int $salarySupplement,
        private readonly DateTimeInterface $employmentYear,
        private readonly SupplementType $supplementType
    ) {}

    public function getBasicSalary(): float
    {
        return $this->basicSalary;
    }

    public function getSalarySupplement(): int
    {
        return $this->salarySupplement;
    }

    public function getEmploymentYear(): DateTimeInterface
    {
        return $this->employmentYear;
    }

    public function getSupplementType(): SupplementType
    {
        return $this->supplementType;
    }
}