<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Application\Providers;

use App\V1\Core\Application\Providers\EventServiceProvider;
use App\V1\Modules\Houses\Notifications\Domain\Events\InitNotificationEventInterface;
use App\V1\Modules\Houses\Notifications\Domain\Events\Listeners\InitNotificationListener;

class NotificationEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        InitNotificationEventInterface::class => [
            InitNotificationListener::class,
        ],
    ];
}
