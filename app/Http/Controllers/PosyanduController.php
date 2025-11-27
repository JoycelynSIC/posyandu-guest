<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    /**
     * Tampilkan daftar Posyandu dengan search (nama, alamat) dan filter (rt, rw)
     */
    public function index(Request $request)
    {
    $posyandu = Posyandu::query()
        // Search global untuk nama & alamat
        ->when($request->search, function ($q, $search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('alamat', 'like', "%{$search}%");
        })
        // Filter dinamis untuk RT & RW
        ->filter($request, ['rt', 'rw'])
        ->orderBy('nama', 'ASC')
        ->paginate(10)
        ->onEachSide(2);

    return view('pages.posyandu.index', compact('posyandu'));
    }


    /**
     * Form tambah Posyandu
     */
    public function create()
    {
        return view('pages.posyandu.create');
    }

    /**
     * Simpan Posyandu baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kontak' => 'required|numeric|digits_between:10,15',
        ], [
            'nama.required' => 'Nama posyandu wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'kontak.required' => 'Nomor kontak wajib diisi.',
            'kontak.numeric' => 'Nomor kontak harus berupa angka.',
            'kontak.digits_between' => 'Nomor kontak harus antara 10 sampai 15 digit.',
        ]);

        Posyandu::create($validated);

        return redirect()->route('posyandu.index')
            ->with('success', 'Data posyandu berhasil ditambahkan!');
    }

    /**
     * Form edit Posyandu
     */
    public function edit(Posyandu $posyandu)
    {
        return view('pages.posyandu.edit', compact('posyandu'));
    }

    /**
     * Update Posyandu
     */
    public function update(Request $request, Posyandu $posyandu)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kontak' => 'required|numeric|digits_between:10,15',
        ], [
            'nama.required' => 'Nama posyandu wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'kontak.required' => 'Nomor kontak wajib diisi.',
            'kontak.numeric' => 'Nomor kontak harus berupa angka.',
            'kontak.digits_between' => 'Nomor kontak harus antara 10 sampai 15 digit.',
        ]);

        $posyandu->update($validated);

        return redirect()->route('posyandu.index')
            ->with('success', 'Data posyandu berhasil diperbarui!');
    }

    /**
     * Hapus Posyandu
     */
    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();

        return redirect()->route('posyandu.index')
            ->with('success', 'Data posyandu berhasil dihapus!');
    }
}
