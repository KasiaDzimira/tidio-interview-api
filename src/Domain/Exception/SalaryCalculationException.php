<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

final class SalaryCalculationException extends Exception implements SalaryServiceException
{
    public function getContext(): string
    {
        return 'NOT_SUPPORTED_CALCULATOR';
    }

    public function getErrorCode(): string
    {
        return $this->getErrorCode();
    }

    public function getExceptionMessage(): string
    {
        return $this->getMessage();
    }
}