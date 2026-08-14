<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        Action::insert([
            [
                'name' => 'list',
                'keys' => 'index,filter'
            ],
            [
                'name' => 'add',
                'keys' => 'create,store'
            ],
            [
                'name' => 'edit',
                'keys' => 'edit,update'
            ],
            [
                'name' => 'delete',
                'keys' => 'destroy,destroy-many'
            ],
            [
                'name' => 'show',
                'keys' => 'show,detail'
            ],
            [
                'name' => 'import',
                'keys' => 'import'
            ],
            [
                'name' => 'export',
                'keys' => 'export'
            ],
            [
                'name' => 'update_status',
                'keys' => 'update-status'
            ],
            [
                'name' => 'update_active',
                'keys' => 'update-active'
            ],
        ]);
    }
}
