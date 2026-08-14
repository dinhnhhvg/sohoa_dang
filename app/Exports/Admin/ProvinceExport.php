<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class ProvinceExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.ward')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->full_name,
            $row?->wards_count
        ];
    }
}
