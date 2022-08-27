<?php

declare(strict_types=1);

namespace App\Tests\Presentation\Request;

use App\Domain\Exception\SalaryReportFilterException;
use App\Presentation\Request\SalaryReportFiltersCollection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SalaryReportFiltersCollectionTest extends TestCase
{
    private ValidatorInterface $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->createMock(ValidatorInterface::class);
    }

    /**
     * @dataProvider filters
     */
    public function testCreateFromArray(array $requestData)
    {
        $filters = SalaryReportFiltersCollection::fromArray(
            $requestData,
            $this->validator
        );

        $this->assertCount(count($requestData), $filters->getFilters());
    }

    public function testCreateFromArrayWithoutSorting()
    {
        $requestData = [
            'department' => 'Human',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'sort_by' => 'department',
            'sort_order' => 'desc',
        ];

        $filters = SalaryReportFiltersCollection::fromArray(
            $requestData,
            $this->validator
        );

        $this->assertCount(3, $filters->getFilters());
    }

    public function testCreateFromArrayThrowsException()
    {
        $requestData = [
            'firstNameAAA' => 'Value',
        ];

        $this->expectException(SalaryReportFilterException::class);

        SalaryReportFiltersCollection::fromArray(
            $requestData,
            $this->validator
        );
    }

    public function filters(): array
    {
        return [
            [
                [
                    'department' => 'Human',
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                ]
            ],
            [
                [
                    'department' => 'Human',
                    'firstName' => 'John',
                ]
            ],
            [
                [
                    'department' => 'Human',
                ]
            ],
            [
                []
            ],
        ];
    }
}