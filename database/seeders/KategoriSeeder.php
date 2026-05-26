<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = [
            'Kulkas',
            'Freezer',
            'Microwave',
            'Oven Listrik',
            'Rice Cooker',
            'Kompor Listrik',
            'Cooker Hood',
            'Dispenser',
            'Blender',
            'Food Processor',
            'Mixer',
            'Juicer',
            'Air Fryer',
            'Sandwich Maker',
            'Coffee Maker',
            'Electric Kettle',
            'Slow Cooker',
            'Dishwasher',
            'Meat Grinder',
            'Ice Maker',
        ];

        foreach ($kategoriList as $kategori) {
            DB::table('kategori')->insert([
                'nama' => $kategori,
            ]);
        }
    }
}
