<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Halaman login (optional)
   public function index()
{
    // khusus admin
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $users = User::orderBy('created_at', 'desc')->paginate(9); 
    return view('pages.users.index', compact('users'));
}


    // Halaman profil user
    public function profile()
    {
        $user = auth()->user(); // user yang sedang login
        return view('pages.users.profile', compact('user'));
    }

    // Halaman edit user
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update nama & email
        $user->name = $request->name;
        $user->email = $request->email;

        // Upload foto profil
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_images', $filename, 'public');

            // Hapus foto lama kalau ada
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $user->profile_image = $path;
        }

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Logout user kalau password diubah
        if ($request->filled('password')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status', 'Password berhasil diubah. Silakan login kembali.');
        }

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        // logout jika user yang dihapus adalah yang login
        if (Auth::id() === $user->id) {
            Auth::logout();
        }

        // Hapus foto lama
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->delete();

        return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
    }

    // Hapus foto profil saja (tanpa hapus akun)
    public function deletePhoto($id)
    {
    $user = User::findOrFail($id);

    // pastikan yang hapus adalah user itu sendiri
    if (Auth::id() !== $user->id) {
        abort(403, 'Akses ditolak');
    }

    // hapus file di storage kalau ada
    if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
        Storage::disk('public')->delete($user->profile_image);
    }

    // set kolom jadi null (balik ke placeholder)
    $user->profile_image = null;
    $user->save();

    return back()->with('success', 'Foto profil berhasil dihapus.');
}
public function updateRole(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|in:admin,user',
    ]);

    // hanya admin yang boleh
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $user->role = $request->role;
    $user->save();

    // kalau admin ngubah role dirinya sendiri → logout
    if (auth()->id() === $user->id) {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Role berhasil diubah. Silakan login ulang.');
    }

    return back()->with('success', 'Role user berhasil diperbarui.');
}


}
