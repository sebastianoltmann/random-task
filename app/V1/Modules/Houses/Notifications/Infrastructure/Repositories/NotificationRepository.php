<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Infrastructure\Repositories;

use App\V1\Core\Infrastructure\Repositories\Eloquent\EloquentModelRepository;
use App\V1\Modules\Houses\Notifications\Domain\Enums\StatusEnum;
use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends EloquentModelRepository<Notification>
 */
class NotificationRepository extends EloquentModelRepository
{
    public function model(): Notification
    {
        return new Notification();
    }

    /**
     * @return Collection<Notification>
     */
    public function getToSend(): Collection
    {
        return $this->query()
            ->whereIn('status', [StatusEnum::INIT, StatusEnum::RETRY])
            ->with(['notifiable', 'owner'])
            ->get();
    }
}
