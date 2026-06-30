<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Promo;
use App\Models\Artikel;
use App\Models\Kontak;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::aktif()->get();
        $kategoris = Kategori::orderBy('nama')->get();
        $produks = Produk::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $promos = Promo::aktif()
            ->orderBy('tanggal_berakhir', 'asc')
            ->take(4)
            ->get();
        $artikels = Artikel::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.home', compact(
            'banners',
            'kategoris',
            'produks',
            'promos',
            'artikels'
        ));
    }

    public function tentangKami()
    {
        return view('frontend.tentang-kami');
    }

    public function produk(Request $request, $kategoriSlug = null)
    {
        $query = Produk::where('is_active', true);

        if ($kategoriSlug) {
            $kategori = Kategori::where('slug', $kategoriSlug)->firstOrFail();
            $query->where('kategori_id', $kategori->id);
        }

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        $produks = $query->orderBy('nama')->paginate(12);
        $kategoris = Kategori::orderBy('nama')->get();
        $totalProduk = Produk::where('is_active', true)->count();

        return view('frontend.produk', compact('produks', 'kategoris', 'totalProduk'));
    }

    public function produkDetail($slug)
    {
        $produk = Produk::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $produksLainnya = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('frontend.produk-detail', compact('produk', 'produksLainnya'));
    }

    public function promo(Request $request)
    {
        $query = Promo::where('is_active', true);

        $status = $request->status;

        if ($status == 'aktif') {
            $query->where('tanggal_mulai', '<=', Carbon::now())
                ->where('tanggal_berakhir', '>=', Carbon::now());
        } elseif ($status == 'berakhir') {
            $query->where('tanggal_berakhir', '<', Carbon::now());
        }

        $promos = $query->orderBy('tanggal_berakhir', 'asc')->paginate(9);

        return view('frontend.promo', compact('promos', 'status'));
    }

    public function promoDetail($slug)
    {
        $promo = Promo::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.promo-detail', compact('promo'));
    }

    public function artikel(Request $request)
    {
        $query = Artikel::where('is_active', true);

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $artikels = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('frontend.artikel', compact('artikels'));
    }

    public function artikelDetail($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $artikelsLainnya = Artikel::where('id', '!=', $artikel->id)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.artikel-detail', compact('artikel', 'artikelsLainnya'));
    }

    public function kontak()
    {
        $kontak = Kontak::first();
        return view('frontend.kontak', compact('kontak'));
    }
}
