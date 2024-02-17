<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Owners\Domain\Models;

use App\V1\Core\Domain\Models\Model;
use App\V1\Shared\Casts\EmailCast;
use App\V1\Shared\VO\EmailVO;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $phone
 * @property EmailVO $email
 */
class Owner extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email',
    ];

    public function getCasts(): array
    {
        return parent::getCasts() + [
                'email' => EmailCast::class,
            ];
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function newCollection(array $models = []): OwnerCollection
    {
        return new OwnerCollection($models);
    }
}
