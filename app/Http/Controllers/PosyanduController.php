<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PosyanduController extends Controller
{
    public function index(Request $request)
    {
        $posyandu = Posyandu::query()
            ->when($request->search, function ($q, $search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            })
            ->filter($request, ['rt', 'rw'])
            ->orderBy('nama', 'ASC')
            ->paginate(10)
            ->onEachSide(2);

        // ✅ placeholder disediakan controller
        $placeholderImage = 'assets/img/placeholderimg.jpg';

        return view('pages.posyandu.index', compact('posyandu', 'placeholderImage'));
    }

    public function create()
    {
        return view('pages.posyandu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kontak' => 'required|numeric|digits_between:10,15',
            'fotos.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $posyandu = Posyandu::create($validated);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = $file->storeAs('posyandu', $originalName, 'public');

                DB::table('media')->insert([
                    'ref_table' => 'posyandu',
                    'ref_id' => $posyandu->posyandu_id,
                    'file_url' => $filename,
                    'caption' => null,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('posyandu.index')
            ->with('success', 'Data posyandu berhasil ditambahkan!');
    }

    public function edit(Posyandu $posyandu)
    {
        $fotos = DB::table('media')
            ->where('ref_table', 'posyandu')
            ->where('ref_id', $posyandu->posyandu_id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.posyandu.edit', compact('posyandu', 'fotos'));
    }

    public function update(Request $request, Posyandu $posyandu)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kontak' => 'required|numeric|digits_between:10,15',
            'fotos.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $posyandu->update($validated);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = $file->storeAs('posyandu', $originalName, 'public');

                DB::table('media')->insert([
                    'ref_table' => 'posyandu',
                    'ref_id' => $posyandu->posyandu_id,
                    'file_url' => $filename,
                    'caption' => null,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('posyandu.index')
            ->with('success', 'Data posyandu berhasil diperbarui!');
    }

    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();

        return redirect()->route('posyandu.index')
            ->with('success', 'Data posyandu berhasil dihapus!');
    }

    public function show($id)
    {
        $posyandu = Posyandu::findOrFail($id);

        $fotos = DB::table('media')
            ->where('ref_table', 'posyandu')
            ->where('ref_id', $posyandu->posyandu_id)
            ->orderBy('sort_order')
            ->get();

        // ✅ placeholder disediakan controller
        $placeholderimage = 'assets/img/placeholderimg.jpg';

        return view('pages.posyandu.detail', compact('posyandu', 'fotos', 'placeholderimage'));
    }

    public function deleteFile($id, $index)
    {
        $file = DB::table('media')
            ->where('ref_table', 'posyandu')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->toArray();

        if (!isset($file[$index])) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $fileToDelete = $file[$index];

        if (Storage::disk('public')->exists($fileToDelete->file_url)) {
            Storage::disk('public')->delete($fileToDelete->file_url);
        }

        DB::table('media')->where('media_id', $fileToDelete->media_id)->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus.');
    }
}
