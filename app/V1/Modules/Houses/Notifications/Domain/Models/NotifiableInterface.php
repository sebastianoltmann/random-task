<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Models;

use Illuminate\Support\Stringable;

interface NotifiableInterface
{
    public function message(): Stringable;
}
