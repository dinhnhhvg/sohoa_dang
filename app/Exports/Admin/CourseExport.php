<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class CourseExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.category'),
            __('app.level'),
            __('app.price'),
            __('app.class'),
            __('app.status')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row->category?->name,
            $row->level?->name,
            $row->price,
            $row->classes_count,
            strip_tags(renderIsActive($row->is_active))
        ];
    }
}
