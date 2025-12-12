<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateFirstUser extends Seeder
{
    public function run()
    {
        // Hapus data lama (opsional)
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'JoyAdmin',
            'email' => 'joy@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('joy111111'), 
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
