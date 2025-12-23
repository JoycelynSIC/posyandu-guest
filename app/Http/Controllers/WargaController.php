<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin', 'agama'];
        $searchableColumns = ['nama', 'no_ktp', 'telp', 'email', 'pekerjaan'];

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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ upload foto hanya kalau ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('warga', 'public');
        }

        Warga::create($validated);

        return redirect()->route('warga.index')
            ->with('success', "Data warga {$validated['nama']} berhasil ditambahkan!");
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
            'email' => 'nullable|email',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // tambahkan
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($warga->foto && Storage::disk('public')->exists($warga->foto)) {
                Storage::disk('public')->delete($warga->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('warga', $filename, 'public');

            $validated['foto'] = 'warga/' . $filename;
        }

        $warga->update($validated);

        return redirect()->route('warga.index')
            ->with('success', "Data warga {$warga->nama} berhasil diperbarui!");

    }


    public function destroy(string $id)
    {
        // Ambil warga dulu sebelum dihapus
        $warga = Warga::findOrFail($id);
        $nama = $warga->nama;

        // Hapus data warga
        Warga::destroy($id);

        // Redirect dengan notifikasi nama warga
        return redirect()->route('warga.index')
            ->with('success', "Data warga {$nama} berhasil dihapus.");
    }



    public function deletePhoto($id)
    {
        $warga = Warga::findOrFail($id);

        if ($warga->foto && Storage::disk('public')->exists($warga->foto)) {
            Storage::disk('public')->delete($warga->foto);
        }

        $warga->foto = null;
        $warga->save();

        return response()->json(['success' => true]);
    }


}
