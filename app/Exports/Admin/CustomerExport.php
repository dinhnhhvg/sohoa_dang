<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class CustomerExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.email'),
            __('app.phone'),
            __('app.gender'),
            __('app.birth_date'),
            __('app.center'),
            __('app.address'),
            __('app.is_active')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row->email,
            $row->phone,
            renderGender($row->gender),
            $row->birth_date?->format('d-m-Y'),
            $row->center?->name,
            formatAddress($row),
            strip_tags(renderIsActive($row->is_active))
        ];
    }
}
