<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications;

use App\V1\Core\Application\Providers\ModuleServiceProvider;
use App\V1\Modules\Houses\Notifications\Application\Providers\NotificationCommandBusServiceProvider;
use App\V1\Modules\Houses\Notifications\Application\Providers\NotificationEventServiceProvider;
use App\V1\Modules\Houses\Notifications\Application\Providers\NotificationServiceProvider;

class NotificationModuleServiceProvider extends ModuleServiceProvider
{
    public const MODULE_NAME = 'notifications';

    public function moduleName(): string
    {
        return self::MODULE_NAME;
    }

    public function register(): void
    {
        parent::register();

        $this->app->register(NotificationServiceProvider::class);
        $this->app->register(NotificationEventServiceProvider::class);
        $this->app->register(NotificationCommandBusServiceProvider::class);
    }
}
