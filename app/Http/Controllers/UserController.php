<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.auth.login', compact('users'));
    }

    public function profile()
    {
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Kirim ke view users.profile
        return view('pages.users.profile', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pages.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    // Update data dasar
    $user->name = $request->name;
    $user->email = $request->email;

    // Kalau user isi password baru
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        $user->save();

        // Logout user saat ini
        Auth::logout();

        // Invalidate session agar benar-benar keluar
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman login
        return redirect()->route('login')->with('status', 'Password berhasil diubah. Silakan login kembali.');
    }

    // Kalau password tidak diubah, hanya update nama/email
    $user->save();

    return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
}

    public function destroy(User $user)
    {
        // logout dulu kalau yang dihapus adalah user yang sedang login
        if (Auth::id() === $user->id) {
            Auth::logout();
        }

        $user->delete();

        return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
    }

    public function showProfile()
    {
        $user = auth()->user(); // ambil user yang sedang login
        return view('users.profile', compact('user'));
    }

}
