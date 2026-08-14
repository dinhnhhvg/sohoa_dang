<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class OldAgencyExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.email'),
            __('app.phone'),
            __('app.description'),
            __('app.record ')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row->email,
            $row->phone,
            $row->description,
            $row->records_count
        ];
    }
}
