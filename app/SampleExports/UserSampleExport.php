<?php

namespace App\SampleExports;

use Maatwebsite\Excel\Concerns\FromArray;

class UserSampleExport implements FromArray
{
    public function array(): array
    {
        return [
            ['name(*)', 'phone(*)', 'email(*)', 'gender(male|female)', 'birth_date(d-m-Y)'],
            ['Nguyen Van A', '0987654321', 'a@example.com', 'male', '01-01-2000'],
            ['Nguyen Van B', '987654321', 'b@example.com', 'female', '01-01-2000'],
        ];
    }
}
