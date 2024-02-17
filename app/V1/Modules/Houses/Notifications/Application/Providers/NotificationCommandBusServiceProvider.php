<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Application\Providers;

use App\V1\Core\Application\Providers\CommandBusServiceProvider;
use App\V1\Modules\Houses\Notifications\Application\Commands\Handlers\StoreNotificationCommandHandler;
use App\V1\Modules\Houses\Notifications\Application\Commands\StoreNotificationCommand;

class NotificationCommandBusServiceProvider extends CommandBusServiceProvider
{
    protected array $commands = [
        StoreNotificationCommand::class => StoreNotificationCommandHandler::class,
    ];
}
