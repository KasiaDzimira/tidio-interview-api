<?php

declare(strict_types=1);

namespace App\Domain\Service\Calculator;

use App\Enum\SupplementType;
use DateTime;
use DateTimeInterface;

final class PercentageSalaryCalculator implements SalaryCalculator
{
    private const MIN_YEARS_OF_EXPERIENCE = 2;

    public function calculate(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear
    ): float {
        $numberOfExperienceYears = $employmentYear->diff(new DateTime())->y;

        if ($numberOfExperienceYears < self::MIN_YEARS_OF_EXPERIENCE) {
            return $basicSalary;
        }

        return $basicSalary + $basicSalary * $salarySupplement * 0.01;
    }

    public function supportsSupplementType(SupplementType $supplementType): bool
    {
        return SupplementType::PERCENTAGE === $supplementType;
    }
}