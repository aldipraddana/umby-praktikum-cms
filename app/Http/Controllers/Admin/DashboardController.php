<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Promo;
use App\Models\Artikel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();
        $totalPromoAktif = Promo::where('is_active', true)
            ->where('tanggal_mulai', '<=', Carbon::now())
            ->where('tanggal_berakhir', '>=', Carbon::now())
            ->count();
        $totalArtikel = Artikel::where('is_active', true)->count();

        return view('admin.dashboard', compact(
            'totalKategori',
            'totalProduk',
            'totalPromoAktif',
            'totalArtikel'
        ));
    }
}
