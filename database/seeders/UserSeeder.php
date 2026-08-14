<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'role_id' => 1,
                'code' => '000001',
                'name' => 'ROOT',
                'email' => 'root@gmail.com',
                'password' => Hash::make(env('APP_DEFAULT_PASSWORD')),
                'phone' => '0123456789',
                'avatar' => env('APP_DEFAULT_AVATAR'),
                'gender' => 'male',
                'is_active' => 1
            ],
            [
                'role_id' => 1,
                'code' => '000002',
                'name' => 'HVG ADMIN',
                'email' => 'hvgadmin@gmail.com',
                'password' => Hash::make(env('APP_DEFAULT_PASSWORD')),
                'phone' => '0987654321',
                'avatar' => env('APP_DEFAULT_AVATAR'),
                'gender' => 'male',
                'is_active' => 1
            ]
        ]);
    }
}
