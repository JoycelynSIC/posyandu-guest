<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Jadwal;
use App\Models\Warga;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * INDEX LAYANAN
     * - User: lihat layanan miliknya sendiri
     * - Admin: lihat semua layanan
     */
    public function index(Request $request)
    {
        $query = Layanan::with(['warga', 'jadwal.posyandu']);

        // filter jadwal_id jika ada
        $jadwal = null;
        if ($request->jadwal_id) {
            $query->where('jadwal_id', $request->jadwal_id);
            $jadwal = Jadwal::with('posyandu')->find($request->jadwal_id);
        }

        // Search nama warga
        if ($request->search) {
            $query->whereHas('warga', function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%");
            });
        }

        // Filter posyandu
        if ($request->posyandu_id) {
            $query->whereHas('jadwal.posyandu', function ($q) use ($request) {
                $q->where('posyandu_id', $request->posyandu_id);
            });
        }

        // Filter bulan
        if ($request->bulan) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->whereMonth('tanggal', date('m', strtotime($request->bulan)))
                    ->whereYear('tanggal', date('Y', strtotime($request->bulan)));
            });
        }

        $layanan = $query->latest()->paginate(9);
        $posyanduList = Posyandu::all();

        return view('pages.layanan.index', compact('layanan', 'posyanduList', 'jadwal'));
    }

    /**
     * FORM CREATE LAYANAN (ADMIN)
     */
    public function create($jadwal_id)
    {
        $jadwal = Jadwal::with('posyandu')->findOrFail($jadwal_id);
        $warga = Warga::orderBy('nama')->get();

        return view('pages.layanan.create', compact('jadwal', 'warga'));
    }

    /**
     * SIMPAN LAYANAN (ADMIN)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal,jadwal_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'berat' => 'nullable|numeric',
            'tinggi' => 'nullable|numeric',
            'vitamin' => 'nullable|string',
            'konseling' => 'required|boolean',
        ]);

        Layanan::create($validated);

        return redirect()
            ->route('layanan.index', ['jadwal_id' => $request->jadwal_id])
            ->with('success', 'Data layanan berhasil ditambahkan');

    }

    /**
     * FORM EDIT LAYANAN (ADMIN)
     */
    public function edit($id)
    {
        $layanan = Layanan::with(['jadwal.posyandu', 'warga'])
            ->findOrFail($id);

        $warga = Warga::orderBy('nama')->get();

        return view('pages.layanan.edit', compact('layanan', 'warga'));
    }

    /**
     * UPDATE LAYANAN (ADMIN)
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'berat' => 'nullable|numeric',
            'tinggi' => 'nullable|numeric',
            'vitamin' => 'nullable|string',
            'konseling' => 'required|boolean',
        ]);

        $layanan->update($validated);

        return redirect()
            ->route('layanan.index', ['jadwal_id' => $layanan->jadwal_id])
            ->with('success', 'Data layanan berhasil diperbarui');
    }

    /**
     * RIWAYAT LAYANAN PER POSYANDU
     */
    public function jadwalLayanan($jadwal_id, Request $request)
    {
        $jadwal = Jadwal::with('posyandu')->findOrFail($jadwal_id);

        $query = Layanan::with(['warga', 'jadwal'])
            ->where('jadwal_id', $jadwal_id);

        if ($request->search) {
            $query->whereHas('warga', fn($q) => $q->where
            ('nama', 'like', "%{$request->search}%"));
        }

        $layanan = $query->latest()->paginate(9);

        return view('pages.layanan.index', compact('jadwal', 'layanan'));
    }

    public function destroy($id)
    {
        // Cari layanan berdasarkan ID
        $layanan = Layanan::findOrFail($id);

        // Hapus data layanan
        $layanan->delete();

        // Redirect kembali ke halaman sebelumnya atau index dengan pesan sukses
        return redirect()->back()->with('success', 'Data layanan berhasil dihapus.');
    }




}
