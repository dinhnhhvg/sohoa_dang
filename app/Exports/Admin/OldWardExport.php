<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class OldWardExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.old_district'),
            __('app.old_province'),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->full_name,
            $row->old_district->name,
            $row->old_province->name
        ];
    }
}
