<?php

declare(strict_types=1);

namespace App\Domain\Service\Calculator;

use App\Enum\SupplementType;
use DateTimeInterface;

final class PercentageSalaryCalculator implements SalaryCalculator
{
    public function calculate(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear
    ): float {
        return $basicSalary + $basicSalary * $salarySupplement * 0.01;
    }

    public function supportsSupplementType(SupplementType $supplementType): bool
    {
        return SupplementType::PERCENTAGE === $supplementType;
    }
}