<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class PoliceExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.description')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row->description
        ];
    }
}
