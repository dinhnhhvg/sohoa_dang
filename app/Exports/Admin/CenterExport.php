<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class CenterExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.classroom'),
            __('app.description'),
            __('app.address '),
            __('app.is_active')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row?->classrooms_count,
            $row->description,
            formatAddress($row),
            strip_tags(renderIsActive($row->is_active))
        ];
    }
}
