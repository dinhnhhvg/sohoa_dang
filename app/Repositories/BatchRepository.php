<?php

namespace App\Repositories;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BatchRepository extends BaseRepository
{
    public function __construct(
        protected Batch $batch
    )
    {
        parent::__construct($batch);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['name'])
            ->filterWhere($filters, ['id', 'status_id', 'type', 'year', 'old_agency_id'])
            ->filterOrderBy($filters)
            ->orderBy('batches.id', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getSum(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('batches.*')
            ->withCount([
                'judgments as check_number_rates_count' => function ($q) {
                    $q->where('check_number_rate', '>', 5);
                }
            ])
            ->withSum('judgments as entry_number_sum', 'entry_number')
            ->withSum('judgments as check_number_sum', 'check_number')
            ->withSum('judgmentDocuments as sheets_sum', 'sheets_count')
            ->withSum('judgmentDocuments as pages_sum', 'pages_count')
            ->withSum('judgmentDocuments as file_size_sum', 'file_size')
            ->filterLike($filters, ['name'])
            ->filterWhere($filters, ['id', 'status_id', 'year', 'type_id', 'old_agency_id'])
            ->filterOrderBy($filters)
            ->orderBy('batches.id', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function reportById(string|int $id): ?Model
    {
        return $this->model->newQuery()
            ->select('batches.*')
            ->with(['status'])
            ->withCount(['judgments', 'entryJudgments', 'checkJudgments', 'judgmentDocuments', 'defendants'])
            ->withSum('judgmentDocuments as sheets_sum', 'sheets_count')
            ->withSum('judgmentDocuments as pages_sum', 'pages_count')
            ->withSum('judgmentDocuments as file_size_sum', 'file_size')
            ->where('batches.id', $id)
            ->first();
    }

    public function reportEntryById(string|int $id): ?Model
    {
        return $this->model->newQuery()
            ->select('batches.*')
            ->with([
                'status',
                'entries' => function ($q) use ($id) {
                    $q->withCount([
                        'entryJudgments as judgments_count' => function ($q) use ($id) {
                            $q->where('batch_id', $id);
                        },
                        'entryJudgments as entry_judgments_count' => function ($q) use ($id) {
                            $q->where('batch_id', $id)
                                ->whereIn('status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
                        },
                        'entryDefendants as defendants_count' => function ($q) use ($id) {
                            $q->whereHas('judgment', function ($q) use ($id) {
                                $q->where('batch_id', $id);
                            });
                        },
                        'entryJudgments as check_judgments_count' => function ($q) use ($id) {
                            $q->where('batch_id', $id)
                                ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                        },
                        'entryJudgments as check_number_done_rates_count' => function ($q) use ($id) {
                            $q->where('batch_id', $id)
                                ->where('check_number_rate', '<=', 5)
                                ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                        }
                    ])
                    ->withSum(['entryJudgments as entry_number_sum' => function ($q) use ($id) {
                        $q->where('batch_id', $id);
                    }], 'entry_number')
                    ->withSum(['entryJudgments as entry_number_done_sum' => function ($q) use ($id) {
                        $q->where('batch_id', $id)
                            ->where('check_number_rate', '<=', 5)
                            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                    }], 'entry_number')
                    ->withSum(['entryJudgments as check_number_error_sum' => function ($q) use ($id) {
                        $q->where('batch_id', $id)
                            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                    }], 'check_number')
                    ->withSum(['entryJudgments as check_number_sum' => function ($q) use ($id) {
                        $q->where('batch_id', $id)
                            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                    }], 'check_number');
                }
            ])
            ->withCount(['judgments', 'judgmentDocuments', 'entryJudgments', 'defendants'])
            ->where('batches.id', $id)
            ->first();
    }

    public function reportCheckById(string|int $id): ?Model
    {
        return $this->model->newQuery()
            ->select('batches.*')
            ->with([
                'status',
                'checkers' => function ($q) use ($id) {
                    $q->withCount([
                        'checkJudgments as judgments_count' => function ($q) use ($id) {
                            $q->where('batch_id', $id);
                        },
                        'checkJudgments as check_judgments_count' => function ($q) use ($id) {
                            $q->where('batch_id', $id)->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                        },
                        'checkDefendants as defendants_count' => function ($q) use ($id) {
                            $q->whereHas('judgment', function ($q) use ($id) {
                                $q->where('batch_id', $id);
                            });
                        }
                    ])
                    ->withSum(['checkJudgments as check_number_sum' => function ($q) use ($id) {
                        $q->where('batch_id', $id)
                            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                    }], 'check_number')
                    ->withSum(['entryJudgments as entry_number_sum' => function ($q) use ($id) {
                        $q->where('batch_id', $id)
                            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                    }], 'entry_number');

                },
            ])
            ->withCount(['judgments', 'judgmentDocuments', 'checkJudgments', 'defendants'])
            ->where('batches.id', $id)
            ->first();
    }

    public function reportDateById(string|int $id, ?array $filter = []): ?Model
    {
        return $this->model->newQuery()
            ->select('batches.*')
            ->with([
                'status',
                'entries' => function ($q) use ($id, $filter) {
                    $q->withCount([
                        'entryJudgments as entry_judgments_count' => function ($q) use ($id, $filter) {
                            $q->where('batch_id', $id)
                                ->filterDate($filter, 'entried_at')
                                ->whereIn('status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
                        },
                        'entryDefendants as entry_defendants_count' => function ($q) use ($id, $filter) {
                            $q->whereHas('judgment', function ($q) use ($id, $filter) {
                                $q->where('batch_id', $id)
                                    ->filterDate($filter, 'entried_at');
                            });
                        }
                    ])
                    ->withSum(['entryJudgments as entry_number_sum' => function ($q) use ($id, $filter) {
                        $q->where('batch_id', $id)
                            ->filterDate($filter, 'entried_at');
                    }], 'entry_number');
                },
                'checkers' => function ($q) use ($id, $filter) {
                    $q->withCount([
                        'checkJudgments as check_judgments_count' => function ($q) use ($id, $filter) {
                            $q->where('batch_id', $id)
                                ->filterDate($filter, 'checked_at')
                                ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                        },
                        'checkDefendants as check_defendants_count' => function ($q) use ($id, $filter) {
                            $q->whereHas('judgment', function ($q) use ($id, $filter) {
                                $q->where('batch_id', $id)
                                    ->filterDate($filter, 'checked_at');
                            });
                        }
                    ])
                    ->withSum(['entryJudgments as check_number_sum' => function ($q) use ($id, $filter) {
                        $q->where('batch_id', $id)
                            ->filterDate($filter, 'checked_at')
                            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
                    }], 'entry_number');

                },
            ])
            ->withCount(['judgments', 'judgmentDocuments', 'entryJudgments', 'defendants'])
            ->where('batches.id', $id)
            ->first();
    }
}
