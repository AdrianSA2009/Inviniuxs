<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $roles = ['admin_gudang', 'manajer'];

        DB::table('karyawan')->insert([
            'nama' => 'Admin Gudang',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin_gudang',
        ]);

        DB::table('karyawan')->insert([
            'nama' => 'Manajer',
            'username' => 'manajer',
            'password' => Hash::make('password'),
            'role' => 'manajer',
        ]);

        for ($i = 0; $i < 25; $i++) {
            DB::table('karyawan')->insert([
                'nama' => $faker->name,
                'username' => $faker->unique()->userName,
                'password' => Hash::make('password'),
                'role' => $roles[array_rand($roles)],
            ]);
        }
    }
}