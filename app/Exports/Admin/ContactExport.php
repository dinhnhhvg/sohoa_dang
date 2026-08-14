<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class ContactExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.title'),
            __('app.content'),
            __('app.schedule_at'),
            __('app.status'),
            __('app.note'),
            __('app.sale'),
            __('app.create_at'),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->customer->name,
            $row->title,
            $row->content,
            $row->schedule_at?->format('d-m-Y'),
            __('app.'.$row->status->name),
            $row->note,
            $row?->sale?->name,
            $row->create_at?->format('d-m-Y H:i:s'),
        ];
    }
}
