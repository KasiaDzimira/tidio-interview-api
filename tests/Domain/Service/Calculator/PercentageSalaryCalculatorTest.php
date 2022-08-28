<?php

declare(strict_types=1);

namespace App\Tests\Domain\Service\Calculator;

use App\Application\Dto\SalaryComponents;
use App\Domain\Service\Calculator\PercentageSalaryCalculator;
use App\Enum\SupplementType;
use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

final class PercentageSalaryCalculatorTest extends TestCase
{
    /**
     * @dataProvider salaryItems
     */
    public function testCalculate(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear,
        float $finalSalary
    )
    {
        $salaryCalculator = new PercentageSalaryCalculator();
        $salaryComponents = new SalaryComponents(
            $basicSalary,
            $salarySupplement,
            $employmentYear,
            SupplementType::PERCENTAGE
        );
        $salary = $salaryCalculator->calculate($salaryComponents);

        $this->assertEquals($finalSalary, $salary);
    }

    public function testSupportsSupplementType()
    {
        $salaryCalculator = new PercentageSalaryCalculator();

        $this->assertTrue($salaryCalculator->supportsSupplementType(SupplementType::PERCENTAGE));
    }

    /**
     * @dataProvider notSupportedSupplementTypes
     */
    public function testNotSupportsSupplementType(SupplementType $supplementType)
    {
        $salaryCalculator = new PercentageSalaryCalculator();

        $this->assertFalse($salaryCalculator->supportsSupplementType($supplementType));
    }

    public function salaryItems(): array
    {
        return [
            [
                'basicSalary' => 1100,
                'salarySupplement' => 10,
                'employmentYear' => new DateTime('20-08-2007'),
                'finalSalary' => 1210
            ],
            [
                'basicSalary' => 1000,
                'salarySupplement' => 20,
                'employmentYear' => new DateTime('-11 months'),
                'finalSalary' => 1200
            ],
            [
                'basicSalary' => 1000,
                'salarySupplement' => 50,
                'employmentYear' => new DateTime('-12 months'),
                'finalSalary' => 1500
            ],
        ];
    }

    public function notSupportedSupplementTypes(): array
    {
        return [
            [SupplementType::FIXED_AMOUNT]
        ];
    }
}