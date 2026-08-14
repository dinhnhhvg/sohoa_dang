<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    public function __construct(
        protected User $user
    )
    {
        parent::__construct($user);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('users.*')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->filterLike($filters, ['users.name', 'users.email', 'users.phone', 'users.code'])
            ->filterWhere($filters, ['role_id', 'center_id', 'province_id', 'is_active'])
            ->filterWhereNot($filters, ['users.id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getByRole(string $roleCode, ?array $withs = null, ?array $withCounts = null): Collection
    {
        $query = $this->model->newQuery()
            ->select('users.*')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('roles.code', $roleCode);
        return $this->getData($query, null, $withs, $withCounts);
    }

    public function getSaleByRole(?string $roleName = null, string|int|null $userId = null): Collection
    {
        $roleName = $roleName ?: session('role_name');
        $userId = $userId ?: session('user_id');

        if ($roleName === 'sale') {
            return $this->model->newQuery->where('id', $userId)->get();
        }
        return $this->get(['role_id' => 3]);
    }

    public function reportBatch(?array $filters = null): Collection
    {
        $query = $this->model->newQuery()
            ->select('users.*')
            ->withCount([
                'entryJudgments as entry_judgments_count' => function ($q) use ($filters) {
                    $q->filterDate($filters, 'entried_at')
                        ->whereIn('status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
                },
                'entryDefendants as entry_defendants_count' => function ($q) use ($filters) {
                    $q->whereHas('judgment', function ($q) use ($filters) {
                        $q->filterDate($filters, 'entried_at')
                            ->whereIn('status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
                    });
                },
                'checkJudgments as check_judgments_count' => function ($q) use ($filters) {
                    $q->filterDate($filters, 'checked_at')
                        ->where('status_id',env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                },
                'checkDefendants as check_defendants_count' => function ($q) use ($filters) {
                    $q->whereHas('judgment', function ($q) use ($filters) {
                        $q->filterDate($filters, 'checked_at')
                            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                    });
                },
            ])
            ->withSum(['entryJudgments as entry_number_sum' => function ($q) use ($filters) {
                $q->filterDate($filters, 'entried_at')
                    ->whereIn('status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
            }], 'entry_number')
            ->withSum(['checkJudgments as check_number_sum' => function ($q) use ($filters) {
                $q->filterDate($filters, 'checked_at')
                    ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
            }], 'check_number')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->filterLike($filters, ['users.name'])
            ->where('roles.code', 'sale');

        return $this->getData($query);
    }
}
