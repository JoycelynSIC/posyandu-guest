<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Jadwal;
use App\Models\Posyandu;
use App\Models\Media;
use App\Models\Layanan;

class JadwalController extends Controller
{
    /**
     * 📌 TAMPILKAN SEMUA JADWAL
     * - dengan filter posyandu
     * - search tema
     */
    public function index(Request $request)
    {
        $posyandu = Posyandu::orderBy('nama')->get();

        // Ambil daftar jadwal
        $jadwal = Jadwal::with(['posyandu', 'media'])
            ->when($request->posyandu_id, fn($q) => $q->where('posyandu_id', $request->posyandu_id))
            ->when($request->search, fn($q) => $q->where('tema', 'like', '%' . $request->search . '%'))
            ->orderBy('tanggal', 'DESC')
            ->paginate(8);

        // Jika ada query jadwal_id → ambil layanan hanya untuk jadwal itu
        $layanan = null;
        $jadwalTerpilih = null;
        if ($request->jadwal_id) {
            $jadwalTerpilih = Jadwal::with('posyandu')->find($request->jadwal_id);
            if ($jadwalTerpilih) {
                $layanan = Layanan::with(['warga', 'jadwal'])
                    ->where('jadwal_id', $jadwalTerpilih->jadwal_id)
                    ->latest()
                    ->paginate(9);
            }
        }

        return view('pages.jadwal.index', compact('jadwal', 'posyandu', 'layanan', 'jadwalTerpilih'));
    }


    /**
     * ➕ FORM TAMBAH JADWAL
     */
    public function create()
    {
        $posyandu = Posyandu::orderBy('nama')->get();
        return view('pages.jadwal.create', compact('posyandu'));
    }

    /**
     * 💾 SIMPAN JADWAL + POSTER
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'posyandu_id' => 'required',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:10240'
        ]);

        $jadwal = Jadwal::create($validated);

        // simpan poster ke tabel media
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            // Pakai nama asli
            $filename = $file->getClientOriginalName();
            // Simpan ke folder 'jadwal' di storage/public
            $path = $file->storeAs('jadwal', $filename, 'public');

            Media::create([
                'ref_table' => 'jadwal',
                'ref_id' => $jadwal->jadwal_id,
                'file_name' => $path,
                'mime_type' => $file->getMimeType(),
                'sort_order' => 1
            ]);
        }
        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal Posyandu berhasil ditambahkan');

    }

    /**
     * ✏️ FORM EDIT JADWAL
     */
    public function edit($id)
    {
        $jadwal = Jadwal::with('media')->findOrFail($id);
        $posyandu = Posyandu::orderBy('nama')->get();

        return view('pages.jadwal.edit', compact('jadwal', 'posyandu'));
    }

    /**
     * 🔄 UPDATE JADWAL + GANTI POSTER
     */
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $validated = $request->validate([
            'posyandu_id' => 'required',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $jadwal->update($validated);

        // Sganti poster lama
        if ($request->hasFile('poster')) {
            $oldPoster = Media::where('ref_table', 'jadwal')
                ->where('ref_id', $jadwal->jadwal_id)
                ->first();

            if ($oldPoster && Storage::disk('public')->exists($oldPoster->file_name)) {
                Storage::disk('public')->delete($oldPoster->file_name);
                $oldPoster->delete();
            }

            $file = $request->file('poster');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('jadwal', $filename, 'public');

            Media::create([
                'ref_table' => 'jadwal',
                'ref_id' => $jadwal->jadwal_id,
                'file_name' => $path,
                'mime_type' => $file->getMimeType(),
                'sort_order' => 1
            ]);
        }


        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    /**
     * 🗑 HAPUS JADWAL + POSTER
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $media = Media::where('ref_table', 'jadwal')
            ->where('ref_id', $jadwal->jadwal_id)
            ->get();

        foreach ($media as $m) {
            if (Storage::disk('public')->exists($m->file_name)) {
                Storage::disk('public')->delete($m->file_name);
            }
            $m->delete();
        }

        $jadwal->delete();

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }

    public function show($id)
    {
        $jadwal = Jadwal::with('posyandu', 'media')->findOrFail($id);
        return view('pages.jadwal.detail', compact('jadwal'));
    }
}
