<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 25; $i++) {
            DB::table('suppliers')->insert([
                'nama' => $faker->company,
                'alamat' => $faker->address,
                'no_telp' => '08' . implode('', array_map(function() { return rand(0, 9); }, range(1, rand(8, 10)))),
            ]);
        }
    }
}