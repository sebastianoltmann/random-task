<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Application\Providers;

use App\V1\Core\Application\Providers\ServiceProvider;
use App\V1\Modules\Houses\Notifications\Domain\Services\NotificationService;
use App\V1\Modules\Houses\Notifications\Domain\Services\NotificationServiceInterface;
use App\V1\Modules\Houses\Notifications\Domain\Strategies\NotifyStrategyInterface;
use App\V1\Modules\Houses\Notifications\UI\CLI\Commands\SendingNotificationCommand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            SendingNotificationCommand::class,
        ]);
    }

    public function register(): void
    {
        $this->app->bind(
            NotificationServiceInterface::class,
            NotificationService::class
        );

        $this->app->when(NotificationService::class)
            ->needs(NotifyStrategyInterface::class)
            ->give(fn(Application $app) => Collection::make(
                config('houses.notifications.strategies', [])
            )->map(fn(string $strategy) => $app->make($strategy))
                ->toArray());
    }
}
