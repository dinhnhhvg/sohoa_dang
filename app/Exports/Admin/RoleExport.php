<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class RoleExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.description'),
            __('app.user'),
            __('app.is_active')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row->description,
            $row?->users_count,
            strip_tags(renderIsActive($row->is_active))
        ];
    }
}
