<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menu utama
        $menuAdministrator = Menu::create(['title' => 'Administrator', 'icon' => 'bi bi-people']);

        // Submenu Administrator
        $submenuItems = [
            [
                'title' => 'Daftar User',
                'link' => 'user.index',
                'role' => 'presiden',
                'parent_id' => $menuAdministrator->id
            ],
            [
                'title' => 'Role & Permission',
                'link' => 'role.index',
                'role' => 'presiden',
                'parent_id' => $menuAdministrator->id
            ]
        ];

        Menu::insert($submenuItems);
        
    }
}
