<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;

class PromoSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan beberapa promo dummy
        Promo::create([
            'title' => 'Diskon 50%',
            'description' => 'Dapatkan diskon 50% untuk semua layanan',
            'discount' => 50,
            'is_active' => true
        ]);
        Promo::create([
            'title' => 'Promo Akhir Tahun',
            'description' => 'Dapatkan promo spesial akhir tahun',
            'discount' => 30,
            'is_active' => true
        ]);
    }
}
