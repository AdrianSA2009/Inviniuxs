<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SessionsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $karyawanIds = DB::table('karyawan')->pluck('id')->toArray();

        for ($i = 0; $i < 25; $i++) {
            DB::table('sessions')->insert([
                'id' => (string) Str::uuid(),
                'user_id' => $faker->boolean(80) ? $karyawanIds[array_rand($karyawanIds)] : null,
                'ip_address' => $faker->ipv4,
                'user_agent' => $faker->userAgent,
                'payload' => json_encode(['_token' => Str::random(40)]),
                'last_activity' => time() - $faker->numberBetween(0, 100000),
            ]);
        }
    }
}
