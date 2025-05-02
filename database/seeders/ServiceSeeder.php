<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menyisipkan data layanan contoh
        Service::insert([
            [
                'category_id' => 1,
                'name' => 'Cuci AC Standard',
                'description' => 'Pembersihan filter dan evaporator.',
                'price' => 75000,
                'image' => 'cuci_ac.jpg',  // Gambar contoh
                'is_outside_area' => false,
                'unit' => 'unit',
            ],
            [
                'category_id' => 2,
                'name' => 'Isi Freon R32',
                'description' => 'Pengisian freon R32 untuk AC 0.5-1 PK.',
                'price' => 150000,
                'image' => 'freon_r32.jpg', // Gambar contoh
                'is_outside_area' => false,
                'unit' => 'unit',
            ],
            [
                'category_id' => 3,
                'name' => 'Instalasi AC Baru',
                'description' => 'Pemasangan unit AC baru lengkap dengan pipa.',
                'price' => 350000,
                'image' => 'instalasi_ac.jpg', // Gambar contoh
                'is_outside_area' => false,
                'unit' => 'unit',
            ],
        ]);
    }
}
