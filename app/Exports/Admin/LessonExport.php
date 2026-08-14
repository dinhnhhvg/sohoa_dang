<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class LessonExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.name'),
            __('app.time'),
            __('app.status'),
            __('app.type'),
            __('app.classroom'),
            __('app.content '),
            __('app.student ')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->name,
            ucfirst($row->date?->translatedFormat('l')).' ('.$row->start_time?->format('H:i').' - '.$row->end_time?->format('H:i').') '.$row->date?->format('d-m-Y'),
            __('app.'.$row->status->name),
            __('app.'.$row->type->name),
            $row->classroom ? ($row->classroom->name.' - '.$row->center?->name) : '',
            $row->content,
            $row->lesson_customers_count ?: 0
        ];
    }
}
