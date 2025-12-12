<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id' => 'required|integer',
            'files' => 'required|array',
            'files.*' => 'file|max:10240', // max 10 MB per file
        ]);

        $saved = [];

        foreach ($request->file('files') as $file) {

            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '-' . Str::random(5)
                    . '.' . $file->getClientOriginalExtension();

            $path = "media/{$request->ref_table}/{$request->ref_id}";
            $file->storeAs($path, $name, 'public');

            $saved[] = Media::create([
                'ref_table' => $request->ref_table,
                'ref_id' => $request->ref_id,
                'file_name' => $name,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return back()->with('success', 'File berhasil diupload!');
    }


    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        $path = "public/media/{$media->ref_table}/{$media->ref_id}/{$media->file_name}";
        if (Storage::exists($path)) Storage::delete($path);

        $media->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
