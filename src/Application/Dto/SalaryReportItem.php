<?php

namespace App\Application\Dto;

final class SalaryReportItem
{
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $department,
        private readonly float $basicSalary,
        private readonly int $salarySupplement,
        private readonly string $supplementType,
        private readonly float $salary
    ) {}

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getBasicSalary(): float
    {
        return $this->basicSalary;
    }

    public function getSalarySupplement(): int
    {
        return $this->salarySupplement;
    }

    public function getSupplementType(): string
    {
        return $this->supplementType;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }
}