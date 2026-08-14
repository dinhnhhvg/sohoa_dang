<?php

namespace App\SampleExports;

use Maatwebsite\Excel\Concerns\FromArray;

class CampaignCustomerSampleExport implements FromArray
{
    public function array(): array
    {
        return [
            ['name(*)', 'email(*)', 'phone(*)'],
            ['Nguyen Van A', '0123456789', 'a@example.com'],
            ['Nguyen Van B', '987654321', 'b@example.com'],
        ];
    }
}
