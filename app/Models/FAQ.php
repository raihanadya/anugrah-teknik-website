<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'faqs'; // ⬅️ ini penting
    protected $fillable = ['question', 'answer'];
}