<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class ClassroomExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.name'),
            __('app.locale '),
            __('app.center'),
            __('app.capacity')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->name,
            $row->locale,
            $row->center->name,
            $row->capacity
        ];
    }
}
