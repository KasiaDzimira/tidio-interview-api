<?php

declare(strict_types=1);

namespace App\Domain\Service\Calculator;

use App\Enum\SupplementType;
use DateTime;
use DateTimeInterface;

final class FixedAmountSalaryCalculator implements SalaryCalculator
{
    private const MAX_YEARS_WITH_SUPPLEMENT = 10;

    public function calculate(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear
    ): float
    {
        $numberOfExperienceYears = $employmentYear->diff(new DateTime())->y;

        $numberOfSupplements = $numberOfExperienceYears < self::MAX_YEARS_WITH_SUPPLEMENT ?
            $numberOfExperienceYears :
            self::MAX_YEARS_WITH_SUPPLEMENT;

        return $basicSalary + $salarySupplement * $numberOfSupplements;
    }

    public function supportsSupplementType(SupplementType $supplementType): bool
    {
        return SupplementType::FIXED_AMOUNT === $supplementType;
    }
}