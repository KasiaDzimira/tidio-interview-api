<?php

namespace App\Domain;

use App\Enum\SupplementType;
use Symfony\Component\Uid\Uuid;

class Department
{
    public function __construct(
        private Uuid $id,
        private string $name,
        private int $salarySupplement,
        private SupplementType $supplementType
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSalarySupplement(): int
    {
        return $this->salarySupplement;
    }

    public function getSupplementType(): SupplementType
    {
        return $this->supplementType;
    }
}