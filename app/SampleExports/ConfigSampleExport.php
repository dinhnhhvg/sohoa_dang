<?php

namespace App\SampleExports;

use Maatwebsite\Excel\Concerns\FromArray;

class ConfigSampleExport implements FromArray
{
    public function array(): array
    {
        return [
            ['code(*)', 'name(*)', 'description'],
            ['a', 'A', 'aaa'],
            ['b', 'B',],
        ];
    }
}
