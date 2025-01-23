<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Mechanic;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BengkelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['nama' => 'Oli']);
        Category::create(['nama' => 'Ban']);
        Category::create(['nama' => 'Aksesoris']);

        // Seed Suppliers
        Supplier::create(['nama' => 'Supplier A', 'kontak' => '08123456789', 'alamat' => 'Jl. Contoh No. 1']);
        Supplier::create(['nama' => 'Supplier B', 'kontak' => '08234567890', 'alamat' => 'Jl. Contoh No. 2']);

        // Seed Spareparts
        Sparepart::create(['nama' => 'Oli Mesin', 'deskripsi' => 'Oli untuk mesin mobil', 'foto' => 'sparepart/oli.jpg', 'harga' => 50000, 'stok' => 100, 'id_kategori' => 1, 'id_supplier' => 1]);
        Sparepart::create(['nama' => 'Ban Mobil', 'deskripsi' => 'Ban untuk mobil sedan', 'foto' => 'sparepart/ban.jpg', 'harga' => 800000, 'stok' => 50, 'id_kategori' => 2, 'id_supplier' => 2]);
        Sparepart::create(['nama' => 'Sticker Motor', 'deskripsi' => 'Sticker untuk motor', 'foto' => 'sparepart/sticker.jpg', 'harga' => 50000, 'stok' => 200, 'id_kategori' => 3, 'id_supplier' => 1]);

        // Seed Mechanics
        Mechanic::create(['nama' => 'Mekanik A', 'telepon' => '08123456780', 'spesialisasi' => 'Mesin']);
        Mechanic::create(['nama' => 'Mekanik B', 'telepon' => '08123456781', 'spesialisasi' => 'Kaki-kaki']);

        // Seed Services
        Service::create(['nama' => 'Servis Rutin', 'deskripsi' => 'Servis berkala untuk mobil', 'harga' => 200000, 'id_mekanik' => 1]);
        Service::create(['nama' => 'Ganti Oli', 'deskripsi' => 'Penggantian oli mesin', 'harga' => 150000, 'id_mekanik' => 2]);

        // Seed Customers
        Customer::create(['nama' => 'Customer A', 'email' => 'customerA@example.com', 'telepon' => '08123456782', 'alamat' => 'Jl. Pelanggan No. 1']);
        Customer::create(['nama' => 'Customer B', 'email' => 'customerB@example.com', 'telepon' => '08123456783', 'alamat' => 'Jl. Pelanggan No. 2']);
    }
}
