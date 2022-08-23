<?php

namespace App\Domain\Service;

use App\Enum\SupplementType;
use DateTimeInterface;

interface Salaries
{
    public function calculateSalary(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear,
        SupplementType $supplementType
    ): float;
}