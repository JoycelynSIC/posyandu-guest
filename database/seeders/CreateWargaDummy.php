<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CreateWargaDummy extends Seeder
{
    public function run()
    {
        DB::table('warga')->truncate();

        $faker = Faker::create('id_ID');
        $wargaData = [];

        foreach (range(1, 50) as $i) {
            $wargaData[] = [
                'warga_id' => $i,
                'no_ktp' => $faker->unique()->numerify('3276############'),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu']),
                'pekerjaan' => $faker->randomElement(['Guru','Pedagang','Ibu Rumah Tangga','Petani','Bidan']),
                'telp' => $faker->numerify('08##########'),
                'email' => $faker->unique()->safeEmail(),
            ];
        }

        DB::table('warga')->insert($wargaData);
    }
}
