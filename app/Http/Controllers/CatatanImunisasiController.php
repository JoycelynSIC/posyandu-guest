<?php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatatanImunisasiController extends Controller
{
   public function index(Request $request)
{
    $query = CatatanImunisasi::with('warga')->orderBy('tanggal', 'desc');

    // Search
    if ($request->search) {
        $query->whereHas('warga', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        })->orWhere('jenis_vaksin', 'like', '%' . $request->search . '%');
    }

    // Filter by warga
    if ($request->warga_id) {
        $query->where('warga_id', $request->warga_id);
    }

    $data = $query->paginate(10)->withQueryString();

    // Ambil semua warga untuk dropdown filter
    $warga = \App\Models\Warga::orderBy('nama')->get();

    return view('pages.imunisasi.index', compact('data', 'warga'));
}



    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('pages.imunisasi.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'jenis_vaksin' => 'required',
            'tanggal' => 'required|date',
            'file_name' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $fileName = null;
        if ($request->hasFile('file_name')) {
            $fileName = time() . '_' . $request->file('file_name')->getClientOriginalName();
            $request->file('file_name')->storeAs('imunisasi', $fileName, 'public');
        }

        CatatanImunisasi::create([
            'warga_id' => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nakes' => $request->nakes,
            'file_name' => $fileName,
        ]);

        return redirect()->route('imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = CatatanImunisasi::with('warga')->findOrFail($id);
        return view('pages.imunisasi.detail', compact('data'));
    }

    public function edit($id)
    {
        $data = CatatanImunisasi::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();
        return view('pages.imunisasi.edit', compact('data', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $data = CatatanImunisasi::findOrFail($id);

        $request->validate([
            'warga_id' => 'required',
            'jenis_vaksin' => 'required',
            'tanggal' => 'required|date',
            'file_name' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        if ($request->hasFile('file_name')) {
            if ($data->file_name) {
                Storage::disk('public')->delete('imunisasi/' . $data->file_name);
            }
            $fileName = time() . '_' . $request->file('file_name')->getClientOriginalName();
            $request->file('file_name')->storeAs('imunisasi', $fileName, 'public');
            $data->file_name = $fileName;
        }

        $data->update([
            'warga_id' => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nakes' => $request->nakes,
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = CatatanImunisasi::findOrFail($id);

        if ($data->file_name) {
            Storage::disk('public')->delete('imunisasi/' . $data->file_name);
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

public function deleteFile($id)
{
    $imunisasi = CatatanImunisasi::findOrFail($id);

    if ($imunisasi->file_name && Storage::disk('public')->exists('imunisasi/' . $imunisasi->file_name)) {
        Storage::disk('public')->delete('imunisasi/' . $imunisasi->file_name);
    }

    $imunisasi->update(['file_name' => null]);

    // Redirect kembali ke halaman edit, bukan index
    return redirect()->route('imunisasi.edit', $id)
                     ->with('success', 'File berhasil dihapus');
}

}
