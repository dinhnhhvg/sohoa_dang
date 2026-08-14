<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class CampaignExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.name'),
            __('app.start_date'),
            __('app.end_date '),
            __('app.customer '),
            __('app.status'),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row->start_date?->format('d-m-Y'),
            $row->end_date?->format('d-m-Y'),
            $row->campaign_customers_count ?: 0,
            __('app.'.$row->status->name),
        ];
    }
}
