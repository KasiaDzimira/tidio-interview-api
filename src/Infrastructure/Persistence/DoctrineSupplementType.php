<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Enum\SupplementType;

final class DoctrineSupplementType extends AbstractStringBackedEnumType
{
    public const NAME = 'supplement_type';

    public static function getEnumsClass(): string
    {
        return SupplementType::class;
    }

    public function getName()
    {
        return self::NAME;
    }
}