<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = ['name', 'category_id', 'description', 'price', 'unit', 'is_outside_area', 'image'];

    // Relasi: service dimiliki oleh kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
