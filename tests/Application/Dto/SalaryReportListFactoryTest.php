<?php

declare(strict_types=1);

namespace App\Tests\Application\Dto;

use App\Application\Dto\Builder\SalaryReportListBuilderInterface;
use App\Application\Dto\SalaryReportList;
use App\Application\Dto\SalaryReportListFactory;
use App\Domain\Department;
use App\Domain\Employee;
use App\Enum\SupplementType;
use DateTime;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Symfony\Component\Uid\Uuid;

final class SalaryReportListFactoryTest extends TestCase
{
    private SalaryReportListBuilderInterface $builder;

    public function setUp(): void
    {
        parent::setUp();

        $this->builder = $this->createMock(SalaryReportListBuilderInterface::class);
    }

    public function testCreate()
    {
        $employees = [
            $this->reflectEmployeeObject(),
            $this->reflectEmployeeObject(),
            $this->reflectEmployeeObject()
        ];

        $factory = new SalaryReportListFactory($this->builder);
        $salaryReport = $factory->create($employees);

        $this->assertInstanceOf(SalaryReportList::class, $salaryReport);
    }

    public function reflectEmployeeObject(): Employee
    {
        $class = new ReflectionClass(Employee::class);
        $constructor = $class->getConstructor();
        $constructor->setAccessible(true);
        $employee = $class->newInstanceWithoutConstructor();
        $constructor->invoke(
            $employee,
            Uuid::v1(),
            'Test name',
            'Test last name',
            new Department(
                Uuid::v1(),
                'Test department name',
                10,
                SupplementType::PERCENTAGE
            ),
            1000.0,
            new DateTime('-10 years')
        );

        return $employee;
    }
}