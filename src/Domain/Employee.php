<?php

namespace App\Domain;

use DateTimeInterface;
use Symfony\Component\Uid\Uuid;

class Employee
{
    public function __construct(
        private Uuid $id,
        private string $firstName,
        private string $lastName,
        private Department $department,
        private float $basicSalary,
        private DateTimeInterface $employmentYear
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