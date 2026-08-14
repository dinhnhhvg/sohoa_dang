<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class ClassCustomerExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code').' '.__('app.student'),
            __('app.name'),
            __('app.status'),
            __('app.start_date'),
            __('app.end_date'),
            __('app.lesson '),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->customer->code,
            $row->customer->name,
            __('app.'.$row->status->name),
            $row->start_date?->format('d-m-Y'),
            $row->end_date?->format('d-m-Y'),
            $row->lesson_customers_count ? (($row->lesson_customer_done_count ?: 0).'/'.$row->lesson_customers_count) : '',
        ];
    }
}
