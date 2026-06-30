<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'slug', 'deskripsi', 'diskon_persen', 'gambar', 'tanggal_mulai', 'tanggal_berakhir', 'is_active'
    ];

    protected $casts = [
        'diskon_persen' => 'decimal:2',
        'tanggal_mulai' => 'datetime',
        'tanggal_berakhir' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function isAktif()
    {
        $now = Carbon::now();
        return $this->is_active && $now->between($this->tanggal_mulai, $this->tanggal_berakhir);
    }

    public function scopeAktif($query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
            ->where('tanggal_mulai', '<=', $now)
            ->where('tanggal_berakhir', '>=', $now);
    }
}
