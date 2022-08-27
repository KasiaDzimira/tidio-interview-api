<?php

namespace App\Presentation\Controller;

use App\Application\Dto\SalaryReportList;
use App\Application\Query\GetSalaryReport\GetSalaryReportQuery;
use App\Enum\SalaryReportSortingFields;
use App\Enum\TimePeriod;
use App\Presentation\Request\SalaryReportFiltersCollection;
use App\Presentation\Request\SalaryReportSorting;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ReportController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $bus,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {}

    /**
     * @OA\Get(
     *     operationId="salaryReport",
     *     @OA\Response(
     *          response=200,
     *          description="Get list of visa requests.",
     *          @Model(type=SalaryReportList::class)
     *     )
     * )
     * @OA\Parameter(
     *     name="department",
     *     in="query",
     *     description="Name of department",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="first_name",
     *     in="query",
     *     description="Employee first name",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="last_name",
     *     in="query",
     *     description="Employee last name",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="sort_by",
     *     in="query",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="sort_order",
     *     in="query",
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Tag(name="salary_report")
     */
    #[Route('/generate-report', name: 'this_month_report_generate', methods: ['GET'])]
    public function generate(Request $request): JsonResponse
    {
        $filters = SalaryReportFiltersCollection::fromArray($request->query->all(), $this->validator);
        $sorting = SalaryReportSorting::fromArray(
            $request->query->all(),
            array_column(SalaryReportSortingFields::cases(), 'value'),
            $this->validator
        );

        $report = $this->bus
            ->dispatch(new GetSalaryReportQuery(TimePeriod::THIS_MONTH, $filters, $sorting))
            ->last(HandledStamp::class)
            ->getResult();

        return new JsonResponse(
            $this->serializer->serialize($report, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}