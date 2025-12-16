<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class CreateJadwalDummy extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal')->truncate();
        // Ambil semua posyandu_id yang ada
        $posyanduIds = DB::table('posyandu')->pluck('posyandu_id')->toArray();

        // Kalau belum ada posyandu, hentikan
        if (count($posyanduIds) === 0) {
            return;
        }

        $temaList = [
            'Penimbangan & Imunisasi Balita',
            'Pemeriksaan Ibu Hamil',
            'Pemberian Vitamin A',
            'Posyandu Lansia',
            'Konseling Gizi Keluarga',
        ];

        $keteranganList = [
            'Kegiatan rutin posyandu untuk memantau kesehatan masyarakat.',
            'Diharapkan seluruh warga hadir sesuai jadwal.',
            'Pelayanan dilakukan oleh kader dan tenaga kesehatan.',
            'Membawa buku KIA atau kartu kesehatan.',
            'Pelayanan dimulai pukul 08.00 WIB.',
        ];

        $jadwalData = [];

        for ($i = 1; $i <= 6; $i++) {
            $jadwalData[] = [
                'posyandu_id' => Arr::random($posyanduIds),
                'tanggal' => Carbon::now()->addDays(rand(3, 45)),
                'tema' => Arr::random($temaList),
                'keterangan' => Arr::random($keteranganList),
            ];
        }

        DB::table('jadwal')->insert($jadwalData);
    }
}
