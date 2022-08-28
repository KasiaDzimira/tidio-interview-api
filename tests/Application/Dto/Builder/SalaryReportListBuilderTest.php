<?php

declare(strict_types=1);

namespace App\Tests\Application\Dto\Builder;

use App\Application\Dto\Builder\SalaryReportListBuilder;
use App\Application\Dto\SalaryReportList;
use App\Domain\Department;
use App\Domain\Employee;
use App\Domain\Service\Salaries;
use App\Enum\SupplementType;
use DateTime;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Symfony\Component\Uid\Uuid;

final class SalaryReportListBuilderTest extends TestCase
{
    private Salaries $salaries;

    public function setUp(): void
    {
        parent::setUp();

        $this->salaries = $this->createMock(Salaries::class);
    }

    public function testBuild()
    {
        $employees = [
            $this->reflectEmployeeObject(),
            $this->reflectEmployeeObject(),
            $this->reflectEmployeeObject()
        ];

        $builder = new SalaryReportListBuilder($this->salaries);
        $salaryReport = $builder->build($employees);

        $this->assertCount(count($employees), $salaryReport->getItems());
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