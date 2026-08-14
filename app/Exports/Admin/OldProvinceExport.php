<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class OldProvinceExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.old_district')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->full_name,
            $row?->old_districs_count
        ];
    }
}
