<?php

declare(strict_types=1);

namespace App\V1\Core\Infrastructure\Repositories\Eloquent;

use App\V1\Core\Domain\Models\Model;
use App\V1\Core\Infrastructure\Repositories\ModelRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\UuidInterface;

/**
 * @template TModel of Model
 */
abstract class EloquentModelRepository implements ModelRepositoryInterface
{
    abstract public function model(): Model;

    /**
     * @return Builder<TModel>
     */
    protected function query(): Builder
    {
        return $this->model()->query();
    }

    /**
     * @return TModel
     */
    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    public function delete(Model $model): void
    {
        $model->delete();
    }

    /**
     * @return TModel
     */
    public function getOneById(UuidInterface|string $id): Model
    {
        return $this->query()->findOrFail((string)$id);
    }
}
