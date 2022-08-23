<?php

declare(strict_types=1);

namespace App\Presentation\Request;

use App\Domain\Exception\SalaryReportFilterException;
use App\Enum\SalaryReportFilters;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SalaryReportFiltersCollection
{
    public function __construct(
        private readonly array $filters
    ) {}

    /**
     * @throws SalaryReportFilterException
     */
    public static function fromArray(?array $requestData, ValidatorInterface $validator): self
    {
        $constraint = new Assert\Collection([
            'allowExtraFields' => true,
            'fields' => [
                SalaryReportFilters::DEPARTMENT->value => new Assert\Optional([
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]),
                SalaryReportFilters::FIRST_NAME->value => new Assert\Optional([
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]),
                SalaryReportFilters::LAST_NAME->value => new Assert\Optional([
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]),
            ]
        ]);

        $violations = $validator->validate($requestData, $constraint);

        if ($violations->count() > 0) {
            throw new SalaryReportFilterException('Invalid filter values for salary report');
        }

        $filters = [];

        foreach ($requestData as $key => $value) {
            if (str_contains($key, 'sort_')) {
                continue;
            }

            if (!in_array($key, array_column(SalaryReportFilters::cases(), 'value'), true)) {
                throw new SalaryReportFilterException('Wrong filter for salary report');
            }

            $filters[] = new SalaryReportFilter($key, $value);
        }

        return new self($filters);
    }

    public function getFilters(): array
    {
        return $this->filters;
    }
}