<?php

namespace Database\Seeders;

use App\Models\OldDistrict;
use App\Models\OldProvince;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class OldDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(storage_path('archive/old_address/districts.json'));
        $data = json_decode($json, true);

        foreach ($data as $row) {
            $oldProvince = OldProvince::where('code', $row['parent_code'])->first();

            $createData = [
                'code' => $row['code'],
                'code_name' => $row['slug'],
                'prefix' => str_replace(' '.$row['name'], '', $row['name_with_type']),
                'name' => $row['name'],
                'full_name' => $row['name_with_type'],
                'old_province_id' => $oldProvince->id
            ];
            OldDistrict::create($createData);
        }
    }
}
