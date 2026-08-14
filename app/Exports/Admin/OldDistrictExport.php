<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class OldDistrictExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.old_province'),
            __('app.old_ward')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->full_name,
            $row->old_province->full_name,
            $row?->old_wards_count
        ];
    }
}
