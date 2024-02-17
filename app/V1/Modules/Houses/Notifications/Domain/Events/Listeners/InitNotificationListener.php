<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Events\Listeners;

use App\V1\Core\Application\Command\CommandBusInterface;
use App\V1\Modules\Houses\Notifications\Application\Commands\StoreNotificationCommand;
use App\V1\Modules\Houses\Notifications\Domain\Events\InitNotificationEventInterface;

final readonly class InitNotificationListener
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {
    }

    public function handle(InitNotificationEventInterface $event)
    {
        $notifiable = $event->notifiable();

        $this->commandBus->dispatch(
            new StoreNotificationCommand(
                $event->owner()->id,
                $notifiable->id,
                $notifiable::class,
                $notifiable->message(),
            )
        );
    }
}
