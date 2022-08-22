<?php

namespace App\Domain;

use DateTimeInterface;
use Symfony\Component\Uid\Uuid;

final class Employee
{
    public function __construct(
        private readonly Uuid $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly Department $department,
        private readonly float $basicSalary,
        private readonly DateTimeInterface $employmentYear
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDepartment(): Department
    {
        return $this->department;
    }

    public function getBasicSalary(): float
    {
        return $this->basicSalary;
    }

    public function getEmploymentYear(): DateTimeInterface
    {
        return $this->employmentYear;
    }
}