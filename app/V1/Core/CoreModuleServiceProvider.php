<?php

declare(strict_types=1);

namespace App\V1\Core;

use App\V1\Core\Application\Providers\CoreRouteServiceProvider;
use App\V1\Core\Application\Providers\CoreServiceProvider;
use App\V1\Core\Application\Providers\ModuleServiceProvider;
use App\V1\Core\Infrastructure\Packeges\Sanctum\Providers\SanctumServiceProvider;
use App\V1\Core\Infrastructure\Packeges\Telescope\Providers\TelescopeApplicationServiceProvider;
use App\V1\Core\Infrastructure\Packeges\Telescope\Providers\TelescopeServiceProvider;

class CoreModuleServiceProvider extends ModuleServiceProvider
{
    public const MODULE_NAME = 'core';

    public function moduleName(): string
    {
        return self::MODULE_NAME;
    }

    public function register(): void
    {
        parent::register();

        $this->app->register(CoreServiceProvider::class);
        $this->app->register(CoreRouteServiceProvider::class);
    }
}
