<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Application\Commands;

use App\V1\Core\Application\Command\CommandTransactionalInterface;
use App\V1\Modules\Houses\Thermostats\Application\Commands\Handlers\StoreTemperatureLogCommandHandler;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @see StoreTemperatureLogCommandHandler
 */
final readonly class StoreTemperatureLogCommand implements CommandTransactionalInterface
{
    public function __construct(
        public UuidInterface $deviceId,
        public float|int $temperature,
        public Carbon $date,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $deviceId = Uuid::fromString($data['deviceId'] ?? $data['device_id']);

        $date = Carbon::createFromTimestamp($data['date']);

        return new self($deviceId, $data['temperature'], $date);
    }
}
