<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua data kategori untuk dicocokkan berdasarkan nama
        $kategoriList = DB::table('kategori')->pluck('id', 'nama')->toArray();

        $barangList = [
            [
                'kategori' => 'Kulkas',
                'nama' => 'Kulkas 2 Pintu Polytron PRB 287PR',
                'harga' => 3245000,
                'deskripsi' => 'Menawarkan kapasitas 240 liter dengan konsumsi daya rendah, cocok untuk menyimpan persediaan keluarga.'
            ],
            [
                'kategori' => 'Freezer',
                'nama' => 'Gea SD-260BY Sliding Curve Glass',
                'harga' => 7140550,
                'deskripsi' => 'Freezer besar dengan pintu kaca geser yang memudahkan kamu melihat isi tanpa harus membukanya.'
            ],
            [
                'kategori' => 'Dishwasher',
                'nama' => 'Beko Freestanding Dishwasher DVN05320W',
                'harga' => 12429628,
                'deskripsi' => 'Mesin pencuci piring yang hemat air dan memiliki fitur cuci cepat 30 menit.'
            ],
            [
                'kategori' => 'Ice Maker',
                'nama' => 'GE Profile Opal 2.0 XL',
                'harga' => 9406685,
                'deskripsi' => 'Mesin pembuat es canggih yang menghasilkan tipe es batu renyah (nugget ice) dengan cepat.'
            ],
            [
                'kategori' => 'Microwave',
                'nama' => 'Samsung MS20A3010AL/ET 20 L',
                'harga' => 881000,
                'deskripsi' => 'Desain kompak dengan pintu kaca elegan untuk menghangatkan makanan.'
            ],
            [
                'kategori' => 'Oven Listrik',
                'nama' => 'Oven Listrik Kirin KBO-90M',
                'harga' => 455000,
                'deskripsi' => 'Oven dengan kapasitas 9 liter dan pengatur waktu, pas untuk memanggang porsi kecil.'
            ],
            [
                'kategori' => 'Rice Cooker',
                'nama' => 'Philips HD4716/30 1.8L',
                'harga' => 825000,
                'deskripsi' => 'Memakai teknologi pemanas 3D untuk memastikan nasi matang secara merata.'
            ],
            [
                'kategori' => 'Kompor Listrik',
                'nama' => 'Modena BI 0721 C Induksi',
                'harga' => 5179000,
                'deskripsi' => 'Kompor tanam dengan panel kontrol sentuh dan perlindungan agar tidak terlalu panas.'
            ],
            [
                'kategori' => 'Cooker Hood',
                'nama' => 'Modena Slim Hood 60cm',
                'harga' => 1319200,
                'deskripsi' => 'Menghisap asap dan aroma menyengat dengan filter karbon aktif agar dapur bebas bau.'
            ],
            [
                'kategori' => 'Blender',
                'nama' => 'Philips HR2041/00 3000 Series',
                'harga' => 1034231,
                'deskripsi' => 'Mampu menghancurkan es batu dalam hitungan detik berkat pisau baja anti karat.'
            ],
            [
                'kategori' => 'Food Processor',
                'nama' => 'Mitochiba Food Chopper CH-100',
                'harga' => 658170,
                'deskripsi' => 'Andalan untuk menggiling daging dan bumbu dapur dalam jumlah banyak sekaligus.'
            ],
            [
                'kategori' => 'Mixer',
                'nama' => 'Cosmos Stand Mixer CM 1289',
                'harga' => 343989,
                'deskripsi' => 'Sangat praktis karena dilengkapi mangkuk pengaduk otomatis dan 5 level kecepatan.'
            ],
            [
                'kategori' => 'Meat Grinder',
                'nama' => 'Kenwood MG516 Electric Mincer',
                'harga' => 9175519,
                'deskripsi' => 'Penggiling daging kokoh berlapis logam yang bisa memproses hingga 2 kg daging per menit.'
            ],
            [
                'kategori' => 'Air Fryer',
                'nama' => 'Mito Air Fryer AF1 Wood Series',
                'harga' => 577150,
                'deskripsi' => 'Memiliki desain pegangan bermotif kayu dan 6 mode untuk menggoreng makanan sehat.'
            ],
            [
                'kategori' => 'Sandwich Maker',
                'nama' => 'Kris Sandwich Maker 1 Slice',
                'harga' => 199500,
                'deskripsi' => 'Ringkas dan cepat untuk membuat roti lapis panggang setiap pagi.'
            ],
            [
                'kategori' => 'Coffee Maker',
                'nama' => 'Delonghi La Specialista Opera',
                'harga' => 23866615,
                'deskripsi' => 'Mesin espresso semi-otomatis dengan penggiling biji kopi terintegrasi untuk hasil standar kafe.'
            ],
            [
                'kategori' => 'Electric Kettle',
                'nama' => 'Xiaomi Mijia Portable Kettle',
                'harga' => 477447,
                'deskripsi' => 'Memanaskan air dengan cepat dan akan mati secara otomatis saat air sudah mendidih.'
            ],
            [
                'kategori' => 'Slow Cooker',
                'nama' => 'Takahi Slow Cooker 0.7 L',
                'harga' => 788000,
                'deskripsi' => 'Sangat ideal untuk memasak kaldu, bubur, atau makanan pendamping ASI dengan stabil.'
            ],
            [
                'kategori' => 'Dispenser',
                'nama' => 'Miyako Water Dispenser WDP-200',
                'harga' => 655000,
                'deskripsi' => 'Desain galon bawah sehingga kamu tidak perlu repot mengangkat galon berat.'
            ],
            [
                'kategori' => 'Juicer',
                'nama' => 'Sharp Countertop EM-121-BK',
                'harga' => 309000,
                'deskripsi' => 'Pembuat jus yang ringkas dan ampuh menjaga sari buah segar.'
            ],
        ];

        foreach ($barangList as $item) {
            // Cari ID kategori berdasarkan nama, gunakan ID pertama tabel jika nama tidak cocok
            $kategoriId = $kategoriList[$item['kategori']] ?? DB::table('kategori')->first()->id;

            DB::table('barang')->insert([
                'kategori_id' => $kategoriId,
                'nama' => $item['nama'],
                'harga' => $item['harga'],
                'deskripsi' => $item['deskripsi'],
                'stok' => 0,
            ]);
        }
    }
}
