<?php

declare(strict_types=1);

namespace App\V1\Core\Application\Enums;

enum EnvironmentEnum: string
{
    case LOCAL = 'local';
    case PRODUCTION = 'production';
}
