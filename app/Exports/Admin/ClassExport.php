<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class ClassExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.course'),
            __('app.course_type'),
            __('app.start_date'),
            __('app.end_date'),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->full_name,
            $row->province->full_name
        ];
    }
}
