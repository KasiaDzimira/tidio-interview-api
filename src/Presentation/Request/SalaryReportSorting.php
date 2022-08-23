<?php

declare(strict_types=1);

namespace App\Presentation\Request;

use App\Domain\Exception\SalaryReportSortingException;
use App\Enum\ListSortingRuleName;
use App\Enum\SalaryReportSortingFields;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SalaryReportSorting
{
    public function __construct(
        private readonly string $sortBy,
        private readonly string $sortOrder
    ) {}

    /**
     * @throws SalaryReportSortingException
     */
    public static function fromArray(
        array $requestData,
        array $sortByChoices,
        ValidatorInterface $validator
    ): ?self {
        $constraint = new Assert\Collection([
            'allowExtraFields' => true,
            'fields' => [
                ListSortingRuleName::SORT_BY->value => new Assert\Optional([
                    new Assert\NotBlank(),
                    new Assert\Choice([
                        'choices' => $sortByChoices,
                    ]),
                ]),
                ListSortingRuleName::SORT_ORDER->value => new Assert\Optional([
                    new Assert\NotBlank(),
                    new Assert\Callback(function ($value, ExecutionContextInterface $context) {
                        if (!in_array(strtoupper($value), [Criteria::ASC, Criteria::DESC])) {
                            $context->buildViolation('Invalid sort order value.')
                                ->atPath(ListSortingRuleName::SORT_ORDER->value)
                                ->addViolation();
                        }
                    }),
                ]),
            ]
        ]);

        $violations = $validator->validate($requestData, $constraint);

        if ($violations->count() > 0) {
            throw new SalaryReportSortingException('Invalid sorting values for salary report');
        }

        if (empty($requestData[ListSortingRuleName::SORT_BY->value]) || empty($requestData[ListSortingRuleName::SORT_ORDER->value])) {
            return new self(SalaryReportSortingFields::FIRST_NAME->value, Criteria::DESC);
        }

        return new self(
            $requestData[ListSortingRuleName::SORT_BY->value],
            $requestData[ListSortingRuleName::SORT_ORDER->value]
        );
    }

    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }
}