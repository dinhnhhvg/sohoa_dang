<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Ward;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvinceWardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(storage_path('archive/province_ward.json'));
        $data = json_decode($json, true);

        foreach ($data as $provinceData) {
            $provinceCreateData = [
                'code' => $provinceData['Code'],
                'code_name' => $provinceData['CodeName'],
                'prefix' => $provinceData['AdministrativeUnitShortName'],
                'name' => $provinceData['Name'],
                'full_name' => $provinceData['FullName'],
            ];
            $province = Province::create($provinceCreateData);
            $provinceId = $province->id;

            if (isset($provinceData['Wards']) && $provinceData['Wards']) {
                foreach ($provinceData['Wards'] as $wardData) {
                    $wardCreateData = [
                        'province_id' => $provinceId,
                        'code' => $wardData['Code'],
                        'code_name' => $wardData['CodeName'],
                        'prefix' => $wardData['AdministrativeUnitShortName'],
                        'name' => $wardData['Name'],
                        'full_name' => $wardData['FullName']
                    ];
                    Ward::insert($wardCreateData);
                }
            }
        }
    }
}
