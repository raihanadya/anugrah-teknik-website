<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan beberapa FAQ dummy
        FAQ::create([
            'question' => 'Apa itu layanan A?',
            'answer' => 'Layanan A adalah layanan yang menawarkan ...'
        ]);
        FAQ::create([
            'question' => 'Bagaimana cara melakukan pemesanan?',
            'answer' => 'Untuk melakukan pemesanan, Anda perlu ...'
        ]);
    }
}
