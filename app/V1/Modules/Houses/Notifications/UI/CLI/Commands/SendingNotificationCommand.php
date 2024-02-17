<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\UI\CLI\Commands;

use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Notifications\Domain\Services\NotificationServiceInterface;
use App\V1\Modules\Houses\Notifications\Infrastructure\Repositories\NotificationRepository;
use Illuminate\Console\Command;

class SendingNotificationCommand extends Command
{
    protected $signature = 'house:notification:send';

    protected $description = 'Send notification to users';

    public function handle(
        NotificationRepository $repository,
        NotificationServiceInterface $service
    ): void {
        $repository->getToSend()
            ->each(
                fn(Notification $notification) => $service
                    ->send($notification)
            );
    }
}
