<?php

namespace App\Domain;

use App\Enum\SupplementType;
use Symfony\Component\Uid\Uuid;

final class Department
{
    public function __construct(
        private readonly Uuid $id,
        private readonly string $name,
        private readonly int $salarySupplement,
        private readonly SupplementType $supplementType
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