<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class CouponExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.type'),
            __('app.value'),
            __('app.min_amount'),
            __('app.max_mount'),
            __('app.start_date'),
            __('app.end_date'),
            __('app.limit'),
            __('app.status')
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            __('app.'.$row->type),
            $row->value,
            $row->min_amount,
            $row->max_mount,
            $row->start_date?->format('d-m-Y'),
            $row->end_date?->format('d-m-Y'),
            $row->limit ? (($row->orders_count ?: 0) . '/' . $row->limit) : ($row->orders_count ?: 0),
            strip_tags(renderIsActive($row->is_active))
        ];
    }
}
