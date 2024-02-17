<?php

declare(strict_types=1);

namespace App\V1\Shared\Traits;

use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    public function getUuidKey()
    {
        return $this->{$this->getUuidKeyName()};
    }

    public function getUuidKeyName(): string
    {
        return $this->uuidKey ?: 'uuid';
    }

    protected static function bootUuidTrait(): void
    {
        $actionSetUuid = function ($model) {
            $uuidKey = $model->getUuidKeyName();
            if (empty($model->getAttribute($uuidKey))) {
                $model->setAttribute($uuidKey, Uuid::uuid4()->toString());
            }
        };

        static::creating($actionSetUuid);
        static::updating($actionSetUuid);
    }
}
