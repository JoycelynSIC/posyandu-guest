<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CreatePosyanduDummy extends Seeder
{
    public function run()
    {
        DB::table('posyandu')->truncate();

        $faker = Faker::create('id_ID');
        $posyanduData = [];

        foreach (range(1, 100) as $i) {
            $posyanduData[] = [
                'posyandu_id' => $i,
                'nama' => 'Posyandu ' . $faker->firstName,
                'alamat' => $faker->address,
                'rt' => $faker->numberBetween(1, 10),
                'rw' => $faker->numberBetween(1, 5),
                'kontak' => $faker->numerify('08##########'),
            ];
        }

        DB::table('posyandu')->insert($posyanduData);
    }
}
