<?php

declare(strict_types=1);

namespace App\V1\Core\Domain\Models;

use App\V1\Shared\Casts\UuidCast;
use App\V1\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Ramsey\Uuid\Uuid;

abstract class Model extends BaseModel
{
    use UuidTrait;

    public $incrementing = false;

    protected $keyType = 'string';

    protected string $uuidKey = 'id';

    public function newInstance($attributes = [], $exists = false): self
    {
        if (!$exists && !isset($this->{$this->getKeyName()})) {
            $attributes[$this->getKeyName()] = Uuid::uuid4();
        }
        
        return parent::newInstance($attributes, $exists);
    }

    public function getFillable(): array
    {
        return array_merge(parent::getFillable(), [
            $this->getKeyName(),
        ]);
    }

    public function getCasts(): array
    {
        return array_merge(parent::getCasts(), [
            $this->getKeyName() => UuidCast::class,
        ]);
    }

    public function getKey(): string
    {
        return (string)parent::getKey();
    }
}
