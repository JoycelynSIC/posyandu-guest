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
        return view('auth.login', compact('users'));
    }

    public function profile()
    {
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Kirim ke view users.profile
        return view('users.profile', compact('user'));
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

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
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
