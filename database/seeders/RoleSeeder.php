<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'code' => 'admin',
                'name' => 'Admin',
                'account' => 'user',
                'is_default' => 1,
                'is_active' => 1
            ],
            [
                'code' => 'accountant',
                'name' => 'Kế toán',
                'account' => 'user',
                'is_default' => 1,
                'is_active' => 1
            ],
            [
                'code' => 'sale',
                'name' => 'Sale',
                'account' => 'user',
                'is_default' => 1,
                'is_active' => 1
            ]
        ]);
    }
}
