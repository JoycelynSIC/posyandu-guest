<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateLayananDummy extends Seeder
{
    /**
     * Jalankan seeder layanan posyandu (data dummy)
     */
    public function run(): void
    {
        // Kosongkan tabel layanan
        DB::table('layanan')->truncate();

        // Ambil semua warga
        $daftarWarga = DB::table('warga')->pluck('warga_id');

        // Ambil semua jadwal
        $daftarJadwal = DB::table('jadwal')->pluck('jadwal_id');

        if ($daftarWarga->isEmpty() || $daftarJadwal->isEmpty()) {
            $this->command->warn(
                'Seeder CreateLayananDummy dibatalkan: data warga atau jadwal masih kosong.'
            );
            return;
        }

        // Daftar vitamin contoh
        $daftarVitamin = ['Vitamin A', 'Vitamin B', 'Vitamin C', null];

        foreach ($daftarJadwal as $jadwal_id) {
            // Pilih 3–7 warga random dari seluruh warga
            $wargaForJadwal = $daftarWarga->shuffle()->take(rand(3, min(7, $daftarWarga->count())));

            foreach ($wargaForJadwal as $warga_id) {
                DB::table('layanan')->insert([
                    'jadwal_id'  => $jadwal_id,
                    'warga_id'   => $warga_id,
                    'berat'      => rand(80, 150) / 10,   // 8.0 – 15.0 kg
                    'tinggi'     => rand(650, 1000) / 10, // 65 – 100 cm
                    'vitamin'    => $daftarVitamin[array_rand($daftarVitamin)],
                    'konseling'  => rand(0, 1),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
