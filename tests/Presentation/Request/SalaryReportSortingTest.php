<?php

declare(strict_types=1);

namespace App\Tests\Presentation\Request;

use App\Enum\SalaryReportSortingFields;
use App\Presentation\Request\SalaryReportSorting;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SalaryReportSortingTest extends TestCase
{
    private ValidatorInterface $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->createMock(ValidatorInterface::class);
    }

    public function testCreateFromArray()
    {
        $requestData = [
            'sort_by' => 'firstName',
            'sort_order' => 'desc',
        ];

        $sorting = SalaryReportSorting::fromArray(
            $requestData,
            array_column(SalaryReportSortingFields::cases(), 'value'),
            $this->validator
        );

        $this->assertEquals($requestData['sort_by'], $sorting->getSortBy());
        $this->assertEquals($requestData['sort_order'], $sorting->getSortOrder());
    }

    public function testCreateFromArrayWithDefaultOrder()
    {
        $requestData = [
            'sort_by' => 'firstName',
        ];

        $sorting = SalaryReportSorting::fromArray(
            $requestData,
            array_column(SalaryReportSortingFields::cases(), 'value'),
            $this->validator
        );

        $this->assertEquals($requestData['sort_by'], $sorting->getSortBy());
        $this->assertEquals('DESC', $sorting->getSortOrder());
    }
}