<?php

declare(strict_types=1);

namespace App\V1\Shared\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidCast implements CastsAttributes
{
    private const UUID_LENGTH = 36;

    public function get($model, string $key, $value, array $attributes): ?UuidInterface
    {
        if ($value === null) {
            return null;
        }

        return Uuid::fromString($value);
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof UuidInterface) {
            return $value->toString();
        }

        if (is_string($value) && strlen($value) === self::UUID_LENGTH) {
            return $value;
        }

        return null;
    }
}
