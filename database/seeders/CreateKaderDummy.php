<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CreateKaderDummy extends Seeder
{
    public function run()
    {
        DB::table('kader_posyandu')->truncate();

        $faker = Faker::create('id_ID');
        $kaderData = [];
        $kaderId = 1;

        // Ambil sebagian warga (misal 30%)
        $allWarga = DB::table('warga')->inRandomOrder()
                    ->limit(DB::table('warga')->count() * 0.3) // ⬅ ambil 30% warga
                    ->get();

        // Ambil posyandu yang cuma 30
        $allPosyandu = DB::table('posyandu')->pluck('posyandu_id')->toArray();

        foreach ($allWarga as $warga) {

            $mulaiTugas = $faker->dateTimeBetween('-5 years', 'now');
            $akhirTugas = $faker->optional()->dateTimeBetween('now', '+2 years');

            $kaderData[] = [
                'kader_id' => $kaderId++,
                'posyandu_id' => $faker->randomElement($allPosyandu),
                'warga_id' => $warga->warga_id,
                'peran' => $faker->randomElement(['Ketua','Bendahara','Sekretaris','Anggota']),
                'mulai_tugas' => $mulaiTugas->format('Y-m-d'),
                'akhir_tugas' => $akhirTugas ? $akhirTugas->format('Y-m-d') : null,
            ];
        }

        DB::table('kader_posyandu')->insert($kaderData);
    }
}

