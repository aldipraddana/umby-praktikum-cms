<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $query = Promo::query();

        if ($request->status == 'aktif') {
            $query->where('is_active', true)
                ->where('tanggal_mulai', '<=', Carbon::now())
                ->where('tanggal_berakhir', '>=', Carbon::now());
        } elseif ($request->status == 'berakhir') {
            $query->where(function ($q) {
                $q->where('is_active', false)
                    ->orWhere('tanggal_berakhir', '<', Carbon::now());
            });
        }

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $promos = $query->orderBy('created_at', 'desc')->get();
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'diskon_persen' => 'required|numeric|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->judul);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads/promo'), $namaGambar);
            $validated['gambar'] = $namaGambar;
        }

        Promo::create($validated);

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'diskon_persen' => 'required|numeric|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->judul);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            if ($promo->gambar && file_exists(public_path('uploads/promo/' . $promo->gambar))) {
                unlink(public_path('uploads/promo/' . $promo->gambar));
            }
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads/promo'), $namaGambar);
            $validated['gambar'] = $namaGambar;
        }

        $promo->update($validated);

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy(Promo $promo)
    {
        if ($promo->gambar && file_exists(public_path('uploads/promo/' . $promo->gambar))) {
            unlink(public_path('uploads/promo/' . $promo->gambar));
        }
        $promo->delete();

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil dihapus');
    }
}
