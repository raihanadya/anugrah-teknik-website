<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Menambahkan beberapa kategori dummy
        Category::create(['name' => 'Layanan A']);
        Category::create(['name' => 'Layanan B']);
        Category::create(['name' => 'Layanan C']);
        Category::create(['name' => 'Layanan D']);
    }
}
