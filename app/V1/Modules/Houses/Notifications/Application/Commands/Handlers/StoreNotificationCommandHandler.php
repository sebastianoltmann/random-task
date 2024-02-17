<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Application\Commands\Handlers;

use App\V1\Core\Application\Command\CommandHandlerInterface;
use App\V1\Core\Application\Command\CommandInterface;
use App\V1\Modules\Houses\Notifications\Application\Commands\StoreNotificationCommand;
use App\V1\Modules\Houses\Notifications\Domain\Enums\StatusEnum;
use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Notifications\Infrastructure\Repositories\NotificationRepository;

final readonly class StoreNotificationCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private NotificationRepository $repository,
    ) {
    }

    /**
     * @param StoreNotificationCommand $command
     */
    public function handle(CommandInterface $command): void
    {
        $notification = new Notification([
            'owner_id' => $command->ownerId,
            'notifiable_id' => $command->notifiableId,
            'notifiable_type' => $command->notifiableType,
            'message' => $command->message,
            'status' => StatusEnum::INIT,
        ]);

        $this->repository->save($notification);
    }
}
