<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = ['title', 'description', 'discount', 'is_active'];

    // Untuk mengubah tipe discount menjadi float jika diperlukan
    protected $casts = [
        'discount' => 'float',
    ];
}
