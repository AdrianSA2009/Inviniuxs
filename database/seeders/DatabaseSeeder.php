<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KategoriSeeder::class,
            SupplierSeeder::class,
            KaryawanSeeder::class,
            BarangSeeder::class,
            BarangMasukSeeder::class,
            UnitBarangSeeder::class,
            BarangKeluarSeeder::class,
            SessionsSeeder::class,
            CacheSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
