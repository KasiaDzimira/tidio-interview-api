<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Service\Calculator\SalaryCalculator;
use App\Enum\SupplementType;
use DateTimeInterface;

final class SalaryProvider implements Salaries
{
    /**
     * @param SalaryCalculator[] $salaryCalculators
     */
    public function __construct(
        private readonly iterable $salaryCalculators
    ) {}

    public function calculateSalary(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear,
        SupplementType $supplementType
    ): float {
        foreach ($this->salaryCalculators as $salaryCalculator) {
            if ($salaryCalculator->supportsSupplementType($supplementType)) {
                return $salaryCalculator->calculate(
                    $basicSalary,
                    $salarySupplement,
                    $employmentYear
                );
            }
        }

        //@TO_DO throw an exception if none of the calculators meet the condition
        return 0;
    }
}