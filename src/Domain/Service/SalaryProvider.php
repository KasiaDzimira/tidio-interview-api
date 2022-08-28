<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Application\Dto\SalaryComponents;
use App\Domain\Exception\SalaryCalculationException;
use App\Domain\Service\Calculator\SalaryCalculator;

final class SalaryProvider implements Salaries
{
    /**
     * @param SalaryCalculator[] $salaryCalculators
     */
    public function __construct(
        private readonly iterable $salaryCalculators
    ) {}

    public function calculateSalary(SalaryComponents $salaryComponents): float {
        foreach ($this->salaryCalculators as $salaryCalculator) {
            if ($salaryCalculator->supportsSupplementType($salaryComponents->getSupplementType())) {
                return $salaryCalculator->calculate($salaryComponents);
            }
        }

        throw new SalaryCalculationException('The calculator for the specified supplement type cannot be found');
    }
}