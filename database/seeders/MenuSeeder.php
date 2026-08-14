<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menuCreateManyData = [
            [
                'parent_id' => null,
                'name' => 'dashboard',
                'router' => 'admin.dashboard'
            ]
        ];

        // Admin administrator
        $menuCreateData = [
            'parent_id' => null,
            'name' => 'administrator',
            'router' => null
        ];
        $menu = Menu::create($menuCreateData);
        $menuId = $menu->id;

        $menuCreateManyData[] = [
            'parent_id' => $menuId,
            'name' => 'list',
            'router' => 'admin.user'
        ];
        $menuCreateManyData[] = [
            'parent_id' => $menuId,
            'name' => 'role',
            'router' => 'admin.role'
        ];

        // Admin address
        $menuCreateData = [
            'parent_id' => null,
            'name' => 'administrator',
            'router' => null
        ];
        $menu = Menu::create($menuCreateData);
        $menuId = $menu->id;

        $menuCreateManyData[] = [
            'parent_id' => $menuId,
            'name' => 'province',
            'router' => 'admin.province'
        ];
        $menuCreateManyData[] = [
            'parent_id' => $menuId,
            'name' => 'ward',
            'router' => 'admin.ward'
        ];

        Menu::insert($menuCreateManyData);
    }
}
