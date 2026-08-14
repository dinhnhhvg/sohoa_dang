<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Center::insert([
            'name' => 'HVG Center',
            'code' => 'HVG-CENTER',
            'address' => '33 Trung Kính',
            'is_active' => 1
        ]);
    }
}
