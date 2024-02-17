<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Services;

use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Notifications\Domain\Strategies\NotifyStrategyInterface;

final class NotificationService implements NotificationServiceInterface
{
    /**
     * @var NotifyStrategyInterface[]
     */
    private array $notifyStrategy;

    public function __construct(
        NotifyStrategyInterface ...$notifyStrategy
    ) {
        $this->notifyStrategy = $notifyStrategy;
    }

    public function send(Notification $notification): void
    {
        foreach ($this->notifyStrategy as $strategy) {
            $strategy->notify($notification->owner, $notification);
        }
    }
}
