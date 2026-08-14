<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    public function scopeFilterLike(Builder $query, ?array $filters, string|array $columns): Builder
    {
        if (isset($filters['search_key']) && $filters['search_key'] !== '') {
            $columns = !is_array($columns) ? [$columns] : $columns;
            $searchKey = $filters['search_key'];
            $query->where(function ($q) use ($columns, $searchKey) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $searchKey . '%');
                }
            });
        }
        return $query;
    }

    public function scopeFilterWhere(Builder $query, ?array $filters, string|array $columns): Builder
    {
        $columns = !is_array($columns) ? [$columns] : $columns;
        foreach ($columns as $column) {
            if (isset($filters[$column]) && $filters[$column]) {
                if ($column === 'whereNull' || $column === 'where_null') {
                    $query->whereNull($filters[$column]);
                    continue;
                }
                if ($column === 'whereNotNull' || $column === 'where_not_null') {
                    $query->whereNotNull($filters[$column]);
                    continue;
                }

                if (is_array($filters[$column])) {
                    if (in_array('0', $filters[$column], true)) {
                        $query->where(function ($q) use ($filters, $column) {
                            $q->whereNull($column)->orWhereIn($column, $filters[$column]);
                        });
                    } else {
                        $query->whereIn($column, $filters[$column]);
                    }
                } else {
                    if ($filters[$column] == 0) {
                        $query->whereNull($columns);
                    } else {
                        $query->where($column, $filters[$column]);
                    }
                }
            }
        }
        return $query;
    }

    public function scopeFilterWhereNot(Builder $query, ?array $filters = null, string|array $columns = 'id'): Builder
    {
        $columns = !is_array($columns) ? [$columns] : $columns;
        foreach ($columns as $column) {
            if (isset($filters['whereNot'][$column]) && $filters['whereNot'][$column]) {
                if (is_array($filters['whereNot'][$column])) {
                    $query->whereNotIn($column, $filters['whereNot'][$column]);
                } else {
                    $query->whereNot($column, $filters['whereNot'][$column]);
                }
            }
        }
        return $query;
    }

    public function scopeFilterDate(Builder $query, ?array $filters, string $column): Builder
    {
        if (isset($filters['start_date']) && $filters['start_date']) {
            $query->where($column, '>=', Carbon::parse($filters['start_date'])->startOfDay());
        }
        if (isset($filters['end_date']) && $filters['end_date']) {
            $query->where($column, '<=', Carbon::parse($filters['end_date'])->endOfDay());
        }
        return $query;
    }

    public function scopeFilterOrderBy(Builder $query, ?array $filters = null): Builder
    {
        if (isset($filters['orderByName'], $filters['orderByType']) && $filters['orderByName'] && $filters['orderByType']) {
            $query->orderBy($filters['orderByName'], $filters['orderByType']);
        }
        return $query;
    }
}
