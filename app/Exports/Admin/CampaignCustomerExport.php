<?php

namespace App\Exports\Admin;

use App\Exports\BaseExport;

class CampaignCustomerExport extends BaseExport
{
    public function headings(): array
    {
        return [
            __('app.code'),
            __('app.customer'),
            __('app.content'),
            __('app.schedule_at '),
            __('app.status '),
            __('app.note'),
            __('app.sale'),
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->name,
            $row->content,
            $row->schedule_at?->format('d-m-Y H:i:s'),
            __('app.'.$row->status->name),
            $row->note,
            $row?->sale?->name,
        ];
    }
}
