<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class VideoExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.name'),
            __('app.description'),
            __('app.category'),
            __('app.type'),
            __('app.videoId'),
            __('app.duration'),
            __('app.status'),
            __('app.created_at'),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->name,
            $row->description,
            $row->category->name,
            __('app.'.$row->type->name),
            $row->videoId,
            isset($row->video['length']) ? gmdate("H:i:s", $row->video['length']) : '',
            $row->video['status'] ?? '',
            $row->created_at->format('d-m-Y H:i:s'),
        ];
    }
}
