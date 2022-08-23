<?php

namespace App\Presentation\Request;

interface InputFilterInterface
{
    public function getKey(): string;

    public function getValue(): string;
}