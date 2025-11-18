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

        // Pilih sebagian warga jadi kader (40%)
        $jumlahKader = intval($allWarga->count() * 0.4);
        $kaderWarga = $allWarga->random($jumlahKader);

        foreach ($kaderWarga as $warga) {
            $posyanduId = $faker->numberBetween(1, 5); // pilih posyandu random

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
