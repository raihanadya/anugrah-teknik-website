<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            FAQSeeder::class,
            PromoSeeder::class,
            ServiceSeeder::class,
            UserSeeder::class,
            ContactMessageSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
