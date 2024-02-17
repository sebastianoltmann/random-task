<?php

declare(strict_types=1);

namespace App\V1\Core\Infrastructure\Repositories;

use App\V1\Core\Domain\Models\Model;
use Ramsey\Uuid\UuidInterface;

interface ModelRepositoryInterface
{
    public function model(): mixed;

    public function save(Model $model): mixed;
    
    public function getOneById(UuidInterface|string $id): mixed;
}
