<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CreateKaderDummy extends Seeder
{
    public function run()
    {
        // Kosongkan tabel kader_posyandu dulu
        DB::table('kader_posyandu')->truncate();

        $faker = Faker::create('id_ID');
        $kaderData = [];
        $kaderId = 1;

        // Ambil semua warga
        $allWarga = DB::table('warga')->get();

        // Ambil semua posyandu
        $allPosyandu = DB::table('posyandu')->pluck('posyandu_id')->toArray();

        foreach ($allWarga as $warga) {
            // Pilih posyandu secara random dari data posyandu
            $posyanduId = $faker->randomElement($allPosyandu);

            $mulaiTugas = $faker->dateTimeBetween('-5 years', 'now');
            $akhirTugas = $faker->optional()->dateTimeBetween('now', '+2 years');

            $kaderData[] = [
                'kader_id' => $kaderId++,
                'posyandu_id' => $posyanduId,
                'warga_id' => $warga->warga_id,
                'peran' => $faker->randomElement(['Ketua','Bendahara','Sekretaris','Anggota']),
                'mulai_tugas' => $mulaiTugas->format('Y-m-d'),
                'akhir_tugas' => $akhirTugas ? $akhirTugas->format('Y-m-d') : null,
            ];
        }

        DB::table('kader_posyandu')->insert($kaderData);
    }
}
