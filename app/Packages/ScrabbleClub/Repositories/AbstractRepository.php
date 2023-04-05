<?php

namespace Scrabble\Repositories;

use App\Core\Database\Model\Paginator;
use App\Core\Database\QueryModifierInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(string $modelFQN)
    {
        $this->model = new $modelFQN();
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findById(int $id, ?array $relations = []): Model
    {
        $qb = $this->createQueryBuilder();
        $qb->with($relations);

        return $qb->findOrFail($id);
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @return Model|null
     */
    public function findByIdOrNull(int $id, ?array $relations = []): ?Model
    {
        $qb = $this->createQueryBuilder();
        $qb->with($relations);

        return $qb->find($id);
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @param array|null $relations
     * @param QueryModifierInterface|null $queryModifier
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findByField(
        string $fieldName,
        mixed $value,
        ?array $relations = [],
        ?QueryModifierInterface $queryModifier = null
    ): Model {
        $qb = $this->createQueryBuilder();
        $queryModifier?->modify($qb);

        return $qb->with($relations)
            ->where($fieldName, $value)
            ->firstOrFail();
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @param array|null $relations
     * @return Model|null
     *
     * @throws ModelNotFoundException
     */
    public function findByFieldOrNull(
        string $fieldName,
        mixed $value,
        ?array $relations = []
    ): ?Model
    {
        $qb = $this->createQueryBuilder();
        return $qb->with($relations)
            ->where($fieldName, $value)
            ->first();
    }

    /**
     * @param Paginator|null $paginator
     * @param array|null $relations
     * @param QueryModifierInterface|null $queryModifier
     * @return Collection|LengthAwarePaginator
     */
    public function findAll(
        ?Paginator $paginator = null,
        ?array $relations = [],
        ?QueryModifierInterface $queryModifier = null
    ): Collection|LengthAwarePaginator {

        if ($paginator) {
            return $this->findAllPaginated($paginator, $relations, $queryModifier);
        }

        $qb = $this->createQueryBuilder();
        $qb->with($relations);
        $queryModifier?->modify($qb);

        return $qb->get();
    }

    /**
     * @param Paginator $paginator
     * @param array|null $relations
     * @param QueryModifierInterface|null $queryModifier
     * @return LengthAwarePaginator
     */
    public function findAllPaginated(
        Paginator $paginator,
        ?array $relations = [],
        ?QueryModifierInterface $queryModifier = null
    ): LengthAwarePaginator {
        $qb = $this->createQueryBuilder()->with($relations);
        $queryModifier?->modify($qb);

        return $paginator->modify($qb);
    }

    /**
     * @param array|null $relations
     * @param QueryModifierInterface|null $queryModifier
     * @return Model|null
     */
    public function firstOrNull(?array $relations = [], ?QueryModifierInterface $queryModifier = null): ?Model
    {
        $qb = $this->createQueryBuilder();
        $qb->with($relations);
        $queryModifier?->modify($qb);

        return $qb->first();
    }

    /**
     * @param array|null $relations
     * @param QueryModifierInterface|null $queryModifier
     * @return Model|null
     */
    public function firstOrNew(?array $relations = [], ?QueryModifierInterface $queryModifier = null): ?Model
    {
        $qb = $this->createQueryBuilder();
        $qb->with($relations);
        $queryModifier?->modify($qb);

        return $qb->firstOrNew();
    }

    /**
     * @param array|null $relations
     * @param QueryModifierInterface|null $queryModifier
     * @return Model|null
     */
    public function firstOrFail(?array $relations = [], ?QueryModifierInterface $queryModifier = null): ?Model
    {
        $qb = $this->createQueryBuilder();
        $qb->with($relations);
        $queryModifier?->modify($qb);

        return $qb->firstOrFail();
    }

    protected function createQueryBuilder(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @param Model $mode
     * @return void
     */
    public function delete(Model $mode): void
    {
        $mode->delete();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        $this->findById($id)?->delete();
    }

    /**
     * @param Collection<Model> $models
     * @return void
     */
    public function deleteMany(Collection $models): void
    {
        foreach ($models as $model) {
            $model->delete();
        }
    }

    /**
     * @param Model $model
     * @return Model
     */
    public function store(Model $model): Model
    {
        $model->save();

        return $model;
    }

    /**
     * @param Collection<Model> $models
     * @return void
     */
    public function storeMany(Collection $models): void
    {
        foreach ($models as $model) {
            $model->save();
        }
    }

    /**
     * @param Model $model
     * @param array|null $relations
     * @return Model|null
     */
    public function fresh(Model $model, ?array $relations = []): ?Model
    {
        return $model->fresh($relations);
    }

    /**
     * @param Model $model
     * @return Model
     */
    public function refresh(Model $model): Model
    {
        return $model->refresh();
    }
}
