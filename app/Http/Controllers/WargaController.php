<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin', 'agama']; // kolom spesifik
        $searchableColumns = ['nama', 'no_ktp', 'telp','email', 'pekerjaan']; // keyword global

        $warga = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('nama', 'ASC')
            ->paginate(10)
            ->onEachSide(2);


        return view('pages.warga.index', compact('warga'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'email' => 'nullable|email',
            'pekerjaan' => 'nullable|string',
            'telp' => 'required',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp' => 'required|numeric|digits:16|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required|string|max:255',
            'telp' => 'nullable|numeric',
            'email' => 'nullable|email'
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        Warga::destroy($id);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
