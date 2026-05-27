<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CacheSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 25; $i++) {
            DB::table('cache')->insert([
                'key' => 'seed:cache:' . $i,
                'value' => json_encode(['data' => $faker->sentence]),
                'expiration' => time() + $faker->numberBetween(60, 3600),
            ]);
        }
    }
}
