<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Center::insert([
            'name' => 'Web',
            'code' => 'web'
        ]);
    }
}
