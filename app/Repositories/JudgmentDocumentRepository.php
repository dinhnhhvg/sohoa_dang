<?php

namespace App\Repositories;

use App\Models\JudgmentDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class JudgmentDocumentRepository extends BaseRepository
{
    public function __construct(
        protected JudgmentDocument $judgmentDocument
    )
    {
        parent::__construct($judgmentDocument);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('judgment_documents.*')
            ->join('judgments', 'judgments.id', '=', 'judgment_documents.judgment_id')
            ->filterLike($filters, ['judgment_documents.name', 'judgment_documents.file_path'])
            ->filterWhere($filters, array_merge($this->baseWhere, ['batch_id', 'judgment_id', 'status_id', 'old_agency_id']))
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getLimit(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('judgment_documents.*')
            ->join('judgments', 'judgments.id', '=', 'judgment_documents.judgment_id')
            ->filterLike($filters, ['judgment_documents.name'])
            ->filterWhere($filters, array_merge($this->baseWhere, ['batch', 'judgment_id', 'status_id']))
            ->filterOrderBy($filters)
            ->limit(1);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function findByFilePath(int|string $FilePath, ?array $withs = null, ?array $withCounts = null): ?Model
    {
        $query = $this->model->newQuery()
            ->where('file_path', $FilePath);
        if ($withs) {
            $query->with($withs);
        }
        if ($withCounts) {
            $query->withCount($withCounts);
        }
        return $query->first();
    }
}
