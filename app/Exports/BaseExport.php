<?php

namespace App\Exports;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BaseExport implements FromCollection, WithHeadings, WithMapping
{
    public Collection $data;

    public function __construct(
        LengthAwarePaginator|Collection $data
    )
    {
        $this->data = $data instanceof LengthAwarePaginator ? $data->getCollection() : $data;
    }

    public function collection(): Collection
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [];
    }

    public function map(mixed $row): array
    {
        return [];
    }
}
