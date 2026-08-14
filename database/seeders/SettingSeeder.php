<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::insert([
            [
                'key' => 'root_password',
                'value' => 'Abc@1234'
            ]
        ]);
    }
}
