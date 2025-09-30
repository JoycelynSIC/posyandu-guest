<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['nama_posyandu']   = 'Posyandu Bina Muda';
        $data['alamat']          = 'Jl. Bina Muda No. 15, RT 02/RW 01, Kel. Mekarjaya';
        $data['kontak']          = '0812-1000-1234';
        $data['jadwal_posyandu'] = [
            [
                'tanggal'    => '2025-10-10',
                'tema'       => 'Pemeriksaan Balita & Ibu Hamil',
                'keterangan' => 'Kegiatan pemeriksaan kesehatan rutin bagi balita dan ibu hamil.'
            ],
            [
                'tanggal'    => '2025-10-25',
                'tema'       => 'Penyuluhan Gizi Seimbang',
                'keterangan' => 'Edukasi pentingnya gizi seimbang bagi ibu dan anak.'
            ]
        ];

        return view('home', $data);
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
}
