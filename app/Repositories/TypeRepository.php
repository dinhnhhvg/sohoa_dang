<?php

namespace App\Repositories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TypeRepository extends BaseRepository
{
    public function __construct(
        protected Type $type
    )
    {
        parent::__construct($type);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['types.code', 'types.name'])
            ->filterWhere($filters, ['module', 'is_active'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getActiveByModule(string $module): Collection
    {
        $filters = [
            'module' => $module,
            'is_active' => [1]
        ];
        return $this->get($filters);
    }

    public function getForCategory(): Collection
    {
        $filters = [
            'module' => ['order', 'resource'],
            'is_active' => [1]
        ];
        return $this->get($filters);
    }

    public function reportBatch(?array $filters = null): Collection
    {
        return $this->model->newQuery()
            ->where([
                'module' => 'judgment',
                'is_active' => 1,
            ])
            ->with([
                'batches' => function ($q) use ($filters) {
                    $q->filterWhere($filters, ['year', 'type_id', 'old_agency_id'])
                        ->withCount([
                        'judgments as judgments_count' => function ($q) use ($filters) {
                            $q->filterWhere($filters, ['status_id']);
                        },
                        'judgmentDocuments as judgment_documents_count' => function ($q) use ($filters) {
                            $q->whereHas('judgment', function ($q) use ($filters) {
                                $q->filterWhere($filters, ['status_id']);
                            });
                        },
                        'defendants as defendants_count' => function ($q) use ($filters) {
                            $q->whereHas('judgment', function ($q) use ($filters) {
                                $q->filterWhere($filters, ['status_id']);
                            });
                        },
                        'defendants as defendant_infos_count' => function ($q) use ($filters) {
                            $q->whereHas('judgment', function ($q) use ($filters) {
                                $q->filterWhere($filters, ['status_id']);
                            })
                                ->where(function ($q) {
                                    $q->orWhere(function ($q) {
                                        $q->whereNotNull('full_name')
                                            ->whereNotNull('identity_number')
                                            ->whereNotNull('birth_date');
                                    })
                                        ->orWhere(function ($q) {
                                            $q->whereNotNull('full_name')
                                                ->whereNotNull('foreign_identity_number')
                                                ->whereNotNull('birth_date');
                                        })
                                        ->orWhere(function ($q) {
                                            $q->whereNotNull('organization_name')
                                                ->whereNotNull('organization_tax_code');
                                        });
                                });
                        }
                    ])
                        ->withSum(['judgmentDocuments as sheets_sum' => function ($q) use ($filters) {
                            $q->whereHas('judgment', function ($q) use ($filters) {
                                $q->filterWhere($filters, ['status_id']);
                            });
                        }], 'sheets_count')
                        ->withSum(['judgmentDocuments as pages_sum' => function ($q) use ($filters) {
                            $q->whereHas('judgment', function ($q) use ($filters) {
                                $q->filterWhere($filters, ['status_id']);
                            });
                        }], 'pages_count')
                        ->withSum(['judgmentDocuments as file_size_sum' => function ($q) use ($filters) {
                            $q->whereHas('judgment', function ($q) use ($filters) {
                                $q->filterWhere($filters, ['status_id']);
                            });
                        }], 'file_size');
                }
            ])
            ->get();
    }
}
