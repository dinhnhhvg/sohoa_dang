<?php

namespace App\Repositories;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

abstract class BaseRepository
{
    protected array $baseWhere;

    public function __construct(
        protected BaseModel $model
    ) {
        $this->baseWhere = ['whereNull', 'where_null', 'whereNotNull', 'where_not_null'];
    }

    public function getName(): string
    {
        return $this->model->getTable();
    }

    public function getSingularName(): string
    {
        return Str::singular($this->model->getTable());
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery();
        if ($withs) {
            $query->with($withs);
        }
        if ($withCounts) {
            $query->withCount($withCounts);
        }
        return $this->getData($query, $filters['per_page'] ?? null);
    }

    public function getData(Builder $query, ?int $perPage = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        if ($withs) {
            $query->with($withs);
        }
        if ($withCounts) {
            $query->withCount($withCounts);
        }
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    public function find(int|string $id, ?array $withs = null, ?array $withCounts = null): ?Model
    {
        $query = $this->model->newQuery();
        if ($withs) {
            $query->with($withs);
        }
        if ($withCounts) {
            $query->withCount($withCounts);
        }
        return $query->find($id);
    }

    public function create(array $data): ?Model
    {
        if ($this->model->getGuarded() === []) {
            $data = array_intersect_key($data, array_flip(Schema::getColumnListing($this->model->getTable())));
        }
        return $this->model->create($data);
    }

    public function createMany(array $data): ?bool
    {
        foreach ($data as $createData) {
            $this->create($createData);
        }
        return true;
    }

    public function update(array|int|string $id, array $data): ?bool
    {
        if (!is_array($id)) {
            $model = $this->model->find($id);
            return $model->fill($data)->save();
        }

        $models = $this->model->whereIn('id', $id)->get();
        foreach ($models as $model) {
            $model->fill($data)->save();
        }
        return true;
    }

    public function delete(array|int|string $id): ?bool
    {
        $ids = is_array($id) ? $id : [$id];
        $deleted = 0;
        foreach ($this->model->whereIn('id', $ids)->get() as $model) {
            if ($model->delete()) {
                $deleted++;
            }
        }
        return $deleted > 0;
    }
}
