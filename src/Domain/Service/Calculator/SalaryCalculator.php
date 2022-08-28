<?php

namespace App\Domain\Service\Calculator;

use App\Application\Dto\SalaryComponents;
use App\Enum\SupplementType;
use DateTimeInterface;

interface SalaryCalculator
{
    public function calculate(SalaryComponents $salaryComponents): float;

    public function supportsSupplementType(SupplementType $supplementType): bool;
}