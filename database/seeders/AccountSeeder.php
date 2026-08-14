<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        Account::insert([
            [
                'code' => 'user',
                'name' => 'user',
                'route' => 'admin',
                'image' => 'assets/common/img/account/admin.png'
            ],
            [
                'code' => 'customer',
                'name' => 'customer',
                'route' => 'customer',
                'image' => 'assets/common/img/account/student.png'
            ],
            [
                'code' => 'parent',
                'name' => 'parent',
                'route' => 'parent',
                'image' => 'assets/common/img/account/parent.png'
            ],
            [
                'code' => 'lecturer',
                'name' => 'lecturer',
                'route' => 'lecturer',
                'image' => 'assets/common/img/account/teacher.png'
            ],
        ]);
    }
}
