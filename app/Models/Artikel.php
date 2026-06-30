<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'slug', 'konten', 'gambar', 'penulis', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
