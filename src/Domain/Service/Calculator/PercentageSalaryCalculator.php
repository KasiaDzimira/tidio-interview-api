<?php

declare(strict_types=1);

namespace App\Domain\Service\Calculator;

use App\Application\Dto\SalaryComponents;
use App\Enum\SupplementType;

final class PercentageSalaryCalculator implements SalaryCalculator
{
    public function calculate(SalaryComponents $salaryComponents): float {
        return $salaryComponents->getBasicSalary() + $salaryComponents->getBasicSalary() * $salaryComponents->getSalarySupplement() * 0.01;
    }

    public function supportsSupplementType(SupplementType $supplementType): bool
    {
        return SupplementType::PERCENTAGE === $supplementType;
    }
}