<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Application\Commands;

use App\V1\Core\Application\Command\CommandTransactionalInterface;
use App\V1\Modules\Houses\Notifications\Application\Commands\Handlers\StoreNotificationCommandHandler;
use Illuminate\Support\Stringable;
use Ramsey\Uuid\UuidInterface;

/**
 * @see StoreNotificationCommandHandler
 */
final readonly class StoreNotificationCommand implements CommandTransactionalInterface
{
    public function __construct(
        public UuidInterface $ownerId,
        public UuidInterface $notifiableId,
        public string $notifiableType,
        public Stringable $message,
    ) {
    }
}
