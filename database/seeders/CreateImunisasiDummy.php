<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Warga;

class CreateImunisasiDummy extends Seeder
{
    public function run()
    {
        $wargaIds = Warga::pluck('warga_id')->toArray();
        $jenisVaksin = ['MR', 'Polio', 'DPT', 'Hepatitis B', 'Campak', 'Varisela'];
        $lokasi = ['Posyandu Melati', 'Posyandu Mawar', 'Posyandu Kenanga', 'Posyandu Anggrek'];
        $nakes = ['Siti Nurhaliza', 'Budi Santoso', 'Rina Permata', 'Ahmad Fauzi', 'Dewi Lestari'];

        $imunisasiData = [];

        for ($i = 0; $i < 50; $i++) {
            $imunisasiData[] = [
                'warga_id'     => $wargaIds[array_rand($wargaIds)],
                'jenis_vaksin' => $jenisVaksin[array_rand($jenisVaksin)],
                'tanggal'      => now()->subDays(rand(0, 900)), // 0–~2,5 tahun lalu
                'lokasi'       => $lokasi[array_rand($lokasi)],
                'nakes'        => $nakes[array_rand($nakes)],
                'file_name'    => null, // bisa dikasih file dummy kalau mau
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        DB::table('catatan_imunisasi')->insert($imunisasiData);
    }
}
