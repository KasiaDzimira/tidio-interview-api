<?php

declare(strict_types=1);

namespace App\Presentation\Listener\Exception;

use App\Domain\Exception\SalaryReportFilterException;
use App\Domain\Exception\SalaryReportSortingException;
use App\Domain\Exception\SalaryServiceException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class ServiceExceptions
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exceptions = [];
        $exception = $event->getThrowable();

        $exception instanceof HandlerFailedException ?
            $exceptions = $exception->getNestedExceptions() :
            $exceptions[] = $exception;

        foreach ($exceptions as $exception) {
            if ($exception instanceof SalaryServiceException) {
                $this->generateResponse($exception, $event);
            }
        }
    }

    private function generateResponse(SalaryServiceException $exception, ExceptionEvent $event)
    {
        $exceptionClass = get_class($exception);
        $map = $this->getErrorNamesMap();

        if (!isset($map[$exceptionClass])) {
            return;
        }

        $event->setResponse(
            new JsonResponse(
                [
                    'exception_message' => $exception->getExceptionMessage(),
                    'error_code' => $map[$exceptionClass]['errorCode']
                ],
            )
        );
    }

    private function getErrorNamesMap(): array
    {
        return [
            SalaryReportFilterException::class => ['errorCode' => Response::HTTP_BAD_REQUEST],
            SalaryReportSortingException::class => ['errorCode' => Response::HTTP_BAD_REQUEST],
        ];
    }
}