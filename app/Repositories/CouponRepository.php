<?php

namespace App\Repositories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CouponRepository extends BaseRepository
{
    public function __construct(
        protected Coupon $coupon
    )
    {
        parent::__construct($this->coupon);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['coupons.code', 'coupons.name'])
            ->filterWhere($filters, ['type', 'is_active'])
            ->filterOrderBy($filters)
            ->orderBy('coupons.created_at', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function findByCode(string $code, ?array $withs = null, ?array $withCounts = null): ?Model
    {
        $query = $this->model->newQuery();
        if ($withs) {
            $query->with($withs);
        }
        if ($withCounts) {
            $query->withCount($withCounts);
        }
        return $query->where('code', $code)->first();
    }
}
