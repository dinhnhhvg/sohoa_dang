<?php

namespace App\Repositories;

use App\Models\Judgment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JudgmentRepository extends BaseRepository
{
    public function __construct(
        protected Judgment $judgment
    )
    {
        parent::__construct($judgment);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['original_record_code'])
            ->filterWhere($filters, ['batch_id', 'is_after_merge', 'tenure_period_id', 'font_id'])
            ->filterOrderBy($filters);

        if (isset($filters['description_status']) && $filters['description_status'] != '') {
            if ($filters['description_status']) {
                $query->whereNotNull('description');
            } else {
                $query->whereNull('description');
            }
        }

        if (isset($filters['check_number_rate_status']) && $filters['check_number_rate_status'] != '') {
            $query->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'))
                ->where('check_number_rate', ($filters['check_number_rate_status'] ? '<=' : '>') ,5);
        }

        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getSum(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->withSum('judgmentDocuments as sheets_sum', 'sheets_count')
            ->withSum('judgmentDocuments as pages_sum', 'pages_count')
            ->withSum('judgmentDocuments as file_size_sum', 'file_size')
            ->filterLike($filters, ['folder_path'])
            ->filterWhere($filters, ['id', 'batch_id', 'is_after_merge', 'status_id', 'entry_id', 'checker_id', 'tenure_period_id', 'font_id'])
            ->filterOrderBy($filters);

            if (isset($filters['description_status']) && $filters['description_status'] != '') {
            if ($filters['description_status']) {
                $query->whereNotNull('description');
            } else {
                $query->whereNull('description');
            }
        }

        if (isset($filters['check_number_rate_status']) && $filters['check_number_rate_status'] != '') {
            $query->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'))
                ->where('check_number_rate', ($filters['check_number_rate_status'] ? '<=' : '>') ,5);
        }

        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function findArray(string|int $id): ?array
    {
        return $this->model->newQuery()
            ->select([
                'id',
                'font_id',
                'tenure_period_id',
                'table_of_contents_number',
                'box_number',
                'dossier_number',
                'retention_period_id',
                'dossier_title',
                'start_date',
                'end_date',
                'description',
                'physical_condition_id'
            ])
            ->with([
                'languages' => function ($q) {
                    $q->selectRaw('languages.id, languages.id as language_id');
                },
                'judgmentDocuments' => function ($q) {
                    $q->select([
                        'id',
                        'judgment_id',
                        'renamed_file_path',
                        'name',
                        'description',
                        'physical_condition_id',
                        'old_agency_id',
                        'document_number',
                        'document_notation',
                        'issue_date',
                        'document_genre_id',
                        'content_summary',
                        'signer',
                        'confidentiality_level_id',
                        'copy_type_id',
                        'keywords',
                        'topic',
                        'original_doc_location',
                        'data_entry_by',
                        'doc_order_in_dossier',
                        'page_number',
                        'info_code',
                        'handwritten_notes',
                        'document_type_id',
                        'note'
                    ])
                        ->with([
                            'languages' => function ($q) {
                                $q->selectRaw('languages.id, languages.id as language_id');
                            },
                        ]);
                }
            ])
            ->where('id', $id)
            ->first()?->toArray();
    }

    public function getByBatchFolderPath(string|int $batchId, string $folderPath): ?Model
    {
        return $this->model->newQuery()
            ->where('batch_id', $batchId)
            ->where('folder_path', $folderPath)
            ->first();
    }

    public function reportEntry($filters): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->selectRaw('
                DATE(judgments.entried_at) as report_date,
                COUNT(judgments.id) as judgments_count
            ')
            ->filterWhere($filters, ['judgments.batch_id', 'judgments.entry_id'])
            ->filterDate($filters, 'judgments.entried_at')
            ->groupBy('report_date')
            ->orderBy('report_date', 'ASC');
        return $this->getData($query);
    }

    public function reportCheck($filters): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->selectRaw('
                DATE(judgments.checked_at) as report_date,
                COUNT(judgments.id) as judgments_count
            ')
            ->filterWhere($filters, ['judgments.batch_id', 'judgments.checker_id'])
            ->filterDate($filters, 'judgments.checked_at')
            ->groupBy('report_date')
            ->orderBy('report_date', 'ASC');
        return $this->getData($query);
    }
}
