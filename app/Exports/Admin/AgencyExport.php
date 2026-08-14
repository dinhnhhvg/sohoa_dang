<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class AgencyExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.email'),
            __('app.phone'),
            __('app.description'),
            __('app.address ')
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
            formatAddress($row)
        ];
    }
}
