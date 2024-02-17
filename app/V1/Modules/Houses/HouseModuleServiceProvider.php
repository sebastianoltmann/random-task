<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses;

use App\V1\Core\Application\Providers\ModuleServiceProvider;
use App\V1\Modules\Houses\Notifications\NotificationModuleServiceProvider;
use App\V1\Modules\Houses\Thermostats\ThermostatModuleServiceProvider;

class HouseModuleServiceProvider extends ModuleServiceProvider
{
    public const MODULE_NAME = 'house';

    public function moduleName(): string
    {
        return self::MODULE_NAME;
    }

    public function register(): void
    {
        parent::register();

        $this->app->register(ThermostatModuleServiceProvider::class);
        $this->app->register(NotificationModuleServiceProvider::class);
    }
}
