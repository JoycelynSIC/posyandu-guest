<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = Warga::all();
        return view('pages.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }
    /**
     * Update the specified resource in storage.
     */
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
    ], [
        'no_ktp.required' => 'Nomor KTP wajib diisi.',
        'no_ktp.numeric' => 'Nomor KTP harus berupa angka.',
        'no_ktp.unique' => 'Nomor KTP sudah digunakan.',
        'nama.required' => 'Nama wajib diisi.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'agama.required' => 'Agama wajib dipilih.',
        'telp.required' => 'Nomor telepon wajib diisi.',
        'telp.numeric' => 'Nomor telepon harus berupa angka.',
        'email.email' => 'Format email tidak valid.',
    ]);

    // Proses update data
    $warga = Warga::findOrFail($id);
    $warga->update($request->all());

    return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Warga::destroy($id);
        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
