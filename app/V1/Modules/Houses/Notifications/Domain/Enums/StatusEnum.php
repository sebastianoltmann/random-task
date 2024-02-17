<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Enums;

enum StatusEnum: string
{
    case INIT = 'init';
    case SENT = 'sent';
    case ERROR = 'error';
    case RETRY = 'retry';
}
