<?php

namespace App\Domain\Exception;

interface SalaryServiceException
{
    public function getContext(): string;
    public function getExceptionMessage(): string;
    public function getErrorCode(): string;
}