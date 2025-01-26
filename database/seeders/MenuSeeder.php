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
        $menuCashier = Menu::create(['title' => 'Cashier', 'icon' => 'bi bi-cart']);
        // Submenu Administrator
        $submenuItems = [
            [
                'title' => 'Order',
                'link' => 'order.index',
                'role' => 'admin',
                'parent_id' => $menuCashier->id
            ],
            [
                'title' => 'Transaksi',
                'link' => 'transaksi.index',
                'role' => 'admin',
                'parent_id' => $menuCashier->id
            ]
        ];

        $menuMaster = Menu::create(['title' => 'Data Master', 'icon' => 'bi bi-box-seam']);
        $submenuItems = [
            [
                'title' => 'Sparepart',
                'link' => 'sparepart.index',
                'role' => 'admin',
                'parent_id' => $menuMaster->id
            ],
            [
                'title' => 'Kategori Sparepart',
                'link' => 'kategori.index',
                'role' => 'admin',
                'parent_id' => $menuMaster->id
            ],
            [
                'title' => 'Service',
                'link' => 'service.index',
                'role' => 'admin',
                'parent_id' => $menuMaster->id
            ],
            [
                'title' => 'Mekanik',
                'link' => 'mekanik.index',
                'role' => 'admin',
                'parent_id' => $menuMaster->id
            ],
            [
                'title' => 'Customer',
                'link' => 'customer.index',
                'role' => 'admin',
                'parent_id' => $menuMaster->id
            ],
            [
                'title' => 'Suplier',
                'link' => 'suplier.index',
                'role' => 'admin',
                'parent_id' => $menuMaster->id
            ],
        ];

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
