<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class OrderExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.customer'),
            __('app.type'),
            __('app.content'),
            __('app.price'),
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
            __('app.'.$row->type->name),
            $row->content,
            $row->total_price,
            __('app.'.$row->status->name),
            $row->note,
            $row?->sale?->name,
            $row->create_at?->format('d-m-Y H:i:s'),
        ];
    }
}
