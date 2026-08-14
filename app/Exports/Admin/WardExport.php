<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class WardExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.province')
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
