<?php

declare(strict_types=1);

namespace App\V1\Shared\Casts;

use App\V1\Shared\VO\EmailVO;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class EmailCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?EmailVO
    {
        if ($value === null) {
            return null;
        }

        return new EmailVO($value);
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof EmailVO) {
            return $value->value();
        }

        $value = $this->get($model, $key, $value, $attributes);

        return $value->value();
    }
}
