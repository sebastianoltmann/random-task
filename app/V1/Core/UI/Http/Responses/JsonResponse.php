<?php

declare(strict_types=1);

namespace App\V1\Core\UI\Http\Responses;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class JsonResponse extends JsonResource
{
    public static $wrap = false;
}
