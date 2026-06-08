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
        
        $batamAddresses = [
            'Jl. Diponegoro No. 123, Batam Centre',
            'Jl. Ahmad Yani No. 45, Nongsa',
            'Jl. Sudirman No. 67, Batu Aji',
            'Jl. Gajah Mada No. 89, Nagoya',
            'Jl. Raflesia No. 101, Sebela Mempela',
            'Jl. Iman Bonjol No. 112, Sagulung',
            'Jl. Sisingamangaraja No. 134, Lubuk Baja',
            'Jl. Jendral Sudirman No. 156, Bulian',
            'Jl. Raden Intan No. 178, Sekupang',
            'Jl. Tanjung Piayu No. 190, Tanjung Piayu',
            'Jl. Muka Kuning No. 201, Muka Kuning',
            'Jl. Belakang Padang No. 212, Belakang Padang',
            'Jl. Seraya No. 223, Tanjung Umban',
            'Jl. Jati No. 234, Batu Aji',
            'Jl. Balikpapan No. 245, Nongsa',
            'Jl. Bengkulu No. 256, Batam Centre',
            'Jl. Cendana No. 267, Nagoya',
            'Jl. Damar No. 278, Sebela Mempela',
            'Jl. Eboni No. 289, Sagulung',
            'Jl. Forestry No. 290, Lubuk Baja',
            'Jl. Gaharu No. 301, Bulian',
            'Jl. Harapan No. 312, Sekupang',
            'Jl. Indah No. 323, Tanjung Piayu',
            'Jl. Jambu No. 334, Muka Kuning',
            'Jl. Kayu No. 345, Belakang Padang',
        ];

        for ($i = 0; $i < 25; $i++) {
            DB::table('suppliers')->insert([
                'nama' => $faker->company,
                'alamat' => $batamAddresses[$i],
                'no_telp' => '08' . implode('', array_map(function() { return rand(0, 9); }, range(1, rand(8, 10)))),
            ]);
        }
    }
}