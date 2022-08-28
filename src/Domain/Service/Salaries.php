<?php

namespace App\Domain\Service;

use App\Application\Dto\SalaryComponents;
use App\Domain\Exception\SalaryCalculationException;

interface Salaries
{
    /**
     * @throws SalaryCalculationException
     */
    public function calculateSalary(SalaryComponents $salaryComponents): float;
}