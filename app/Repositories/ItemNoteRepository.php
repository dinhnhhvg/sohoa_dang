<?php

namespace App\Repositories;

use App\Models\ItemNote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemNoteRepository extends BaseRepository
{
    public function __construct(
        protected ItemNote $itemNote
    )
    {
        parent::__construct($itemNote);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterWhere($filters, ['account', 'item_type'])
            ->filterDate($filters, 'item_notes.created_at')
            ->filterOrderBy($filters)
            ->orderBy('item_notes.created_at', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
