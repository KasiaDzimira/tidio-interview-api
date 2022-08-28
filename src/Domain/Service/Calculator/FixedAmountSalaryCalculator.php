<?php

declare(strict_types=1);

namespace App\Domain\Service\Calculator;

use App\Application\Dto\SalaryComponents;
use App\Enum\SupplementType;
use DateTime;

final class FixedAmountSalaryCalculator implements SalaryCalculator
{
    private const MAX_YEARS_WITH_SUPPLEMENT = 10;

    public function calculate(SalaryComponents $salaryComponents): float
    {
        $numberOfExperienceYears = $salaryComponents->getEmploymentYear()->diff(new DateTime())->y;

        $numberOfSupplements = $numberOfExperienceYears < self::MAX_YEARS_WITH_SUPPLEMENT ?
            $numberOfExperienceYears :
            self::MAX_YEARS_WITH_SUPPLEMENT;

        return $salaryComponents->getBasicSalary() + $salaryComponents->getSalarySupplement() * $numberOfSupplements;
    }

    public function supportsSupplementType(SupplementType $supplementType): bool
    {
        return SupplementType::FIXED_AMOUNT === $supplementType;
    }
}