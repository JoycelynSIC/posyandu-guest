<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\Posyandu;
use App\Models\Warga;
use Illuminate\Http\Request;

class KaderController extends Controller
{
    /**
     * Halaman Index (tampilkan semua kader dengan filter & pagination)
     */
    public function index(Request $request)
    {
        // Ambil semua Posyandu untuk dropdown filter
        $posyandu = Posyandu::orderBy('nama')->get();

        // Query Kader dengan relasi Warga dan Posyandu + filter
        $kader = Kader::with(['warga', 'posyandu'])
            ->when($request->search, function ($query, $search) {
                $query->whereHas('warga', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->when($request->posyandu_id, function ($query, $posyandu_id) {
                $query->where('posyandu_id', $posyandu_id);
            })
            ->orderBy('kader_id', 'ASC')
            ->paginate(12)
            ->withQueryString(); // penting agar filter tetap aktif saat pagination

        // Ambil total jumlah kader
        $kaderAktif = Kader::count();

        // Kirim data ke view
        return view('pages.kader.index', compact('kader', 'posyandu', 'kaderAktif'));
    }

    /**
     * Halaman Tambah
     */
    public function create()
    {
        $posyandu = Posyandu::all();
        $warga = Warga::all();

        return view('pages.kader.create', compact('posyandu', 'warga'));
    }

    /**
     * Simpan Data Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date',
        ]);

        Kader::create($request->all());

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil ditambahkan.');
    }

    /**
     * Halaman Edit
     */
    public function edit($id)
    {
        $kader = Kader::findOrFail($id);
        $posyandu = Posyandu::all();
        $warga = Warga::all();

        return view('pages.kader.edit', compact('kader', 'posyandu', 'warga'));
    }

    /**
     * Update Data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date',
        ]);

        $kader = Kader::findOrFail($id);
        $kader->update($request->all());

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil diperbarui.');
    }

    /**
     * Hapus Data
     */
    public function destroy($id)
    {
        $kader = Kader::findOrFail($id);
        $kader->delete();

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil dihapus.');
    }
}
