<?php

namespace App\Exports\Admin\Batch;

use App\Exports\BaseExport;

class ConfigExport extends BaseExport
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
