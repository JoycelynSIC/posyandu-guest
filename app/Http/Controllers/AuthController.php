<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        //Mengecek apakah username & password kosong
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username & password wajib diisi.');
        }

        //Mengecek panjang password minimal 3 karakter
        if (strlen($password) < 3) {
            return redirect()->back()->with('error', 'Password minimal harus 3 karakter.');
        }

        //Mengecek apakah password mengandung huruf kapital
        if (!preg_match('/[A-Z]/', $password)) {
            return redirect()->back()->with('error', 'Password harus mengandung huruf kapital.');
        }

        //ika semua rule berhasil → simpan username ke session
        session(['username' => $username]);

        //Mengarahkan ke halaman baru 
        return redirect()->route('auth.welcome');
    }
}

