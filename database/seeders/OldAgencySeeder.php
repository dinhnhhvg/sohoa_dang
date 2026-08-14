<?php

namespace Database\Seeders;

use App\Models\OldAgency;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class OldAgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(storage_path('archive/old_agency.csv'));
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            $oldAgency = OldAgency::where('code', $row['Ma_toa_cha'])->first();

            $createData = [
                'code' => $row['Ma_TSN'],
                'name' => $row['Ten_TSN'],
                'old_agency_id' => ($oldAgency->id ?? null)
            ];
            OldAgency::create($createData);
        }
    }
}
