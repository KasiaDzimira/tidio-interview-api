<?php

declare(strict_types=1);

namespace App\Tests\Domain\Service\Calculator;

use App\Domain\Service\Calculator\FixedAmountSalaryCalculator;
use App\Enum\SupplementType;
use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

final class FixedAmountSalaryCalculatorTest extends TestCase
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
        $salaryCalculator = new FixedAmountSalaryCalculator();
        $salary = $salaryCalculator->calculate($basicSalary, $salarySupplement, $employmentYear);

        $this->assertEquals($finalSalary, $salary);
    }

    public function testSupportsSupplementType()
    {
        $salaryCalculator = new FixedAmountSalaryCalculator();

        $this->assertTrue($salaryCalculator->supportsSupplementType(SupplementType::FIXED_AMOUNT));
    }

    /**
     * @dataProvider notSupportedSupplementTypes
     */
    public function testNotSupportsSupplementType(SupplementType $supplementType)
    {
        $salaryCalculator = new FixedAmountSalaryCalculator();

        $this->assertFalse($salaryCalculator->supportsSupplementType($supplementType));
    }

    public function salaryItems(): array
    {
        return [
            [
                'basicSalary' => 1000,
                'salarySupplement' => 100,
                'employmentYear' => new DateTime('20-08-2007'),
                'finalSalary' => 2000
            ],
            [
                'basicSalary' => 1000,
                'salarySupplement' => 100,
                'employmentYear' => new DateTime('-11 months'),
                'finalSalary' => 1000
            ],
            [
                'basicSalary' => 1000,
                'salarySupplement' => 100,
                'employmentYear' => new DateTime('-12 months'),
                'finalSalary' => 1100
            ],
            [
                'basicSalary' => 1000,
                'salarySupplement' => 100,
                'employmentYear' => new DateTime('-10 years'),
                'finalSalary' => 2000
            ],
            [
                'basicSalary' => 1000,
                'salarySupplement' => 100,
                'employmentYear' => new DateTime('-9 years'),
                'finalSalary' => 1900
            ],
        ];
    }

    public function notSupportedSupplementTypes(): array
    {
        return [
            [SupplementType::PERCENTAGE]
        ];
    }
}