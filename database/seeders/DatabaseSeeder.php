<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinceWardSeeder::class,
            CenterSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ActionSeeder::class,
            MenuSeeder::class,
            SettingSeeder::class,
            AccountSeeder::class
        ]);
    }
}
