<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 4 jadwal terdekat (hari ini & ke depan)
        $jadwal = Jadwal::whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->take(4)
            ->get();

        return view('pages.dashboard', compact('jadwal'));
    }
}
