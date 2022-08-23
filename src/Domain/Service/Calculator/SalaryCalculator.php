<?php

namespace App\Domain\Service\Calculator;

use App\Enum\SupplementType;
use DateTimeInterface;

interface SalaryCalculator
{
    public function calculate(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear
    ): float;

    public function supportsSupplementType(SupplementType $supplementType): bool;
}