<?php

declare(strict_types=1);

namespace App\Tests\Domain\Service;

use App\Application\Dto\SalaryComponents;
use App\Domain\Service\Calculator\FixedAmountSalaryCalculator;
use App\Domain\Service\Calculator\PercentageSalaryCalculator;
use App\Domain\Service\Calculator\SalaryCalculator;
use App\Domain\Service\SalaryProvider;
use App\Enum\SupplementType;
use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

final class SalaryProviderTest extends TestCase
{
    /** @var SalaryCalculator[] */
    private iterable $salaryCalculators;

    public function setUp(): void
    {
        parent::setUp();

        $this->salaryCalculators = [
            new FixedAmountSalaryCalculator(),
            new PercentageSalaryCalculator()
        ];
    }

    /**
     * @dataProvider salaryInformation
     */
    public function testCalculateSalary(
        float $basicSalary,
        int $salarySupplement,
        DateTimeInterface $employmentYear,
        SupplementType $supplementType,
        float $finalSalary
    )
    {
        $salaryProvider = new SalaryProvider($this->salaryCalculators);
        $salaryComponents = new SalaryComponents(
            $basicSalary,
            $salarySupplement,
            $employmentYear,
            $supplementType
        );
        $salary = $salaryProvider->calculateSalary($salaryComponents);

        $this->assertEquals($finalSalary, $salary);
    }

    public function salaryInformation(): array
    {
        return [
            [
                'basicSalary' => 1000,
                'salarySupplement' => 100,
                'employmentYear' => new DateTime('-10 years'),
                'supplementType' => SupplementType::FIXED_AMOUNT,
                'finalSalary' => 2000,
            ],
            [
                'basicSalary' => 1000,
                'salarySupplement' => 10,
                'employmentYear' => new DateTime('-10 years'),
                'supplementType' => SupplementType::PERCENTAGE,
                'finalSalary' => 1100,
            ]
        ];
    }
}