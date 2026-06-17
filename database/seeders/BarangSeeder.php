<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = DB::table('kategori')->pluck('id', 'nama')->toArray();

        $barangList = [
            [
                'kategori' => 'Kulkas',
                'nama' => 'Polytron Kulkas 2 Pintu PRB 287PR',
                'harga' => 3245000,
                'deskripsi' => 'Menawarkan kapasitas 240 liter dengan konsumsi daya rendah, cocok untuk menyimpan persediaan keluarga.',
                'nama_gambar' => '8xshwy3vCCIdkJVVHGEqoTyMt4daS3KhNkg6pdo2.jpg', 
            ],
            [
                'kategori' => 'Freezer',
                'nama' => 'Gea SD-260BY Sliding Curve Glass',
                'harga' => 7140550,
                'deskripsi' => 'Freezer besar dengan pintu kaca geser yang memudahkan kamu melihat isi tanpa harus membukanya.',
                'nama_gambar' => 'YgCd1zsZjiHWplDiMjojmdLzqhG13ChXuhDsp1b7.jpg', 
            ],
            [
                'kategori' => 'Dishwasher',
                'nama' => 'Beko Freestanding Dishwasher DVN05320W',
                'harga' => 12429628,
                'deskripsi' => 'Mesin pencuci piring yang hemat air dan memiliki fitur cuci cepat 30 menit.',
                'nama_gambar' => '5gsGQePWDyQdM1K0qMyiO7fqcyKmYyuI0qdtcckJ.jpg', 
            ],
            [
                'kategori' => 'Ice Maker',
                'nama' => 'GE Profile Opal 2.0 XL',
                'harga' => 9406685,
                'deskripsi' => 'Mesin pembuat es canggih yang menghasilkan tipe es batu renyah (nugget ice) dengan cepat.',
                'nama_gambar' => '2VfDihja7takElTUZceTAAWIXfLZ7dYhd5wkTPeX.jpg',
            ],
            [
                'kategori' => 'Microwave',
                'nama' => 'Samsung MS20A3010AL/ET 20 L',
                'harga' => 881000,
                'deskripsi' => 'Desain kompak dengan pintu kaca elegan untuk menghangatkan makanan.',
                'nama_gambar' => 'DnVXiVl9qyg6MlEMb2RsOWRDZNCXpb20EJKukvDT.jpg',
            ],
            [
                'kategori' => 'Oven Listrik',
                'nama' => 'Oven Listrik Kirin KBO-90M',
                'harga' => 455000,
                'deskripsi' => 'Oven dengan kapasitas 9 liter dan pengatur waktu, pas untuk memanggang porsi kecil.',
                'nama_gambar' => 'gmdS7k0hkG4A1kXQhB5sDuAezeqt5TAIb4BVXunS.jpg',
            ],
            [
                'kategori' => 'Rice Cooker',
                'nama' => 'Philips HD4716/30 1.8L',
                'harga' => 825000,
                'deskripsi' => 'Memakai teknologi pemanas 3D untuk memastikan nasi matang secara merata.',
                'nama_gambar' => 'lK9Pgy1DZ8fhaALN68MHRN2yOQ6hMRO49mOyi3t4.jpg',
            ],
            [
                'kategori' => 'Kompor Listrik',
                'nama' => 'Modena BI 0721 C Induksi',
                'harga' => 5179000,
                'deskripsi' => 'Kompor tanam dengan panel kontrol sentuh dan perlindungan agar tidak terlalu panas.',
                'nama_gambar' => 'afi3OnEzKuCGdgiDC2WY5tgolqheL2EGiazKD98h.jpg',
            ],
            [
                'kategori' => 'Cooker Hood',
                'nama' => 'Modena Slim Hood 60cm',
                'harga' => 1319200,
                'deskripsi' => 'Menghisap asap dan aroma menyengat dengan filter karbon aktif agar dapur bebas bau.',
                'nama_gambar' => 'cWuxxcPUlWUMx9hgBx9GlAt8zzkD2WPFFQ0CCmWK.png',
            ],
            [
                'kategori' => 'Blender',
                'nama' => 'Philips HR2041/00 3000 Series',
                'harga' => 1034231,
                'deskripsi' => 'Mampu menghancurkan es batu dalam hitungan detik berkat pisau baja anti karat.',
                'nama_gambar' => 'o7XcPIAowdGZCIspZNsvqdufF4P47gVk4h6RYMXk.jpg',
            ],
            [
                'kategori' => 'Food Processor',
                'nama' => 'Mitochiba Food Chopper CH-100',
                'harga' => 658170,
                'deskripsi' => 'Andalan untuk menggiling daging dan bumbu dapur dalam jumlah banyak sekaligus.',
                'nama_gambar' => 'hzbNEEVJIg008EACii7xWypo2AFohtmVvmfJtknM.jpg',
            ],
            [
                'kategori' => 'Mixer',
                'nama' => 'Cosmos Stand Mixer CM 1289',
                'harga' => 343989,
                'deskripsi' => 'Sangat praktis karena dilengkapi mangkuk pengaduk otomatis dan 5 level kecepatan.',
                'nama_gambar' => 'XGPE8DjCMGaXm1rXefTnngKA36Ey2AtX9PkV6NtT.webp',
            ],
            [
                'kategori' => 'Meat Grinder',
                'nama' => 'Kenwood MG516 Electric Mincer',
                'harga' => 9175519,
                'deskripsi' => 'Penggiling daging kokoh berlapis logam yang bisa memproses hingga 2 kg daging per menit.',
                'nama_gambar' => 'IdT9NdNMT8zJYUq8RfbzSxMTFidj5uxvz1YLIMoA.jpg',
            ],
            [
                'kategori' => 'Air Fryer',
                'nama' => 'Mito Air Fryer AF1 Wood Series',
                'harga' => 577150,
                'deskripsi' => 'Memiliki desain pegangan bermotif kayu dan 6 mode untuk menggoreng makanan sehat.',
                'nama_gambar' => 'NyZsT4nqMayZFtNEEdXsJm4a7mi5MY3XQ5OUXF6Y.webp',
            ],
            [
                'kategori' => 'Sandwich Maker',
                'nama' => 'Kris Sandwich Maker 1 Slice',
                'harga' => 199500,
                'deskripsi' => 'Ringkas dan cepat untuk membuat roti lapis panggang setiap pagi.',
                'nama_gambar' => 'Z6Ra8mwu6id7dtDs5PDvtb5dYSH7iaVWYPJyw32N.webp',
            ],
            [
                'kategori' => 'Coffee Maker',
                'nama' => 'Delonghi La Specialista Opera',
                'harga' => 23866615,
                'deskripsi' => 'Mesin espresso semi-otomatis dengan penggiling biji kopi terintegrasi untuk hasil standar kafe.',
                'nama_gambar' => 'sZP2OfVRE0AchfktsrdOfBXx7jzhC4TimxARpkn7.jpg',
            ],
            [
                'kategori' => 'Electric Kettle',
                'nama' => 'Xiaomi Mijia Portable Kettle',
                'harga' => 477447,
                'deskripsi' => 'Memanaskan air dengan cepat dan akan mati secara otomatis saat air sudah mendidih.',
                'nama_gambar' => 'MKQCA9PI2su5HX1ho1JFoZFQa3kpajUGnsDTccCe.jpg',
            ],
            [
                'kategori' => 'Slow Cooker',
                'nama' => 'Takahi Slow Cooker 0.7 L',
                'harga' => 788000,
                'deskripsi' => 'Sangat ideal untuk memasak kaldu, bubur, atau makanan pendamping ASI dengan stabil.',
                'nama_gambar' => 'QhmbWr7KadBX0Y5pfFcfk7n4eUZjSjox3CZ5c4LA.webp',
            ],
            [
                'kategori' => 'Dispenser',
                'nama' => 'Miyako Water Dispenser WDP-200',
                'harga' => 655000,
                'deskripsi' => 'Desain galon bawah sehingga kamu tidak perlu repot mengangkat galon berat.',
                'nama_gambar' => '2PvUnJzJuJGOHhPqnflIwWSO7ahfXQP07Qx6yYB2.webp',
            ],
            [
                'kategori' => 'Juicer',
                'nama' => 'Sharp Countertop EM-121-BK',
                'harga' => 309000,
                'deskripsi' => 'Pembuat jus yang ringkas dan ampuh menjaga sari buah segar.',
                'nama_gambar' => 'POhJDAC8TLC7s5uo1cVv3zKFSgu9EyjS49dvmEY5.jpg',
            ],
        ];

        foreach ($barangList as $item) {
            $kategoriId = $kategoriList[$item['kategori']] ?? DB::table('kategori')->first()->id;

            $gambarPath = 'barang/' . $item['nama_gambar'];

            DB::table('barang')->insert([
                'kategori_id' => $kategoriId,
                'nama' => $item['nama'],
                'harga' => $item['harga'],
                'deskripsi' => $item['deskripsi'],
                'gambar' => $gambarPath,
                'stok' => 0,
            ]);
        }
    }
}
