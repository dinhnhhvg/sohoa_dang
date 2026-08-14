<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class PaymentExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.customer'),
            __('app.order'),
            __('app.total_amount'),
            __('app.name'),
            __('app.payment_method'),
            __('app.amount'),
            __('app.expiry_date'),
            __('app.content'),
            __('app.status'),
            __('app.payment_time'),
            __('app.note'),
            __('app.sale'),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->customer->name,
            $row->order->id,
            $row->order->total_amount,
            $row->name,
            $row->payment_method->name,
            $row->amount,
            $row->expiry_date?->format('d-m-Y H:i:s'),
            $row->content,
            __('app.'.$row->status->name),
            $row->payment_time?->format('d-m-Y H:i:s'),
            $row->note,
            $row?->sale?->name
        ];
    }
}
