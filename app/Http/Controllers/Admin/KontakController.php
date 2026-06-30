<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'peta' => 'nullable|string',
        ]);

        Kontak::truncate();
        Kontak::create($validated);

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Informasi kontak berhasil disimpan');
    }

    public function update(Request $request, Kontak $kontak)
    {
        $validated = $request->validate([
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'peta' => 'nullable|string',
        ]);

        $kontak->update($validated);

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Informasi kontak berhasil diperbarui');
    }
}
