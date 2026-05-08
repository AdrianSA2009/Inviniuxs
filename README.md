<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<div align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind" />
</div>

# Aplikasi Stok Gudang Elektronik

Aplikasi Stok Gudang Elektronik adalah sistem informasi berbasis web yang dirancang untuk membantu pengelolaan dan pemantauan persediaan barang di gudang elektronik. Sistem ini mempermudah pencatatan stok, barang masuk, dan barang keluar agar lebih tertata secara sistematis.

Proyek ini dikembangkan sebagai bagian dari tugas *Project Based Learning* (PBL) Program Studi Teknik Informatika, Politeknik Negeri Batam.

## 👥 Tim Pengembang (PBL IF-2PC-05)

* **Manajer Proyek:** Dwi Amalia Purnamasari, S.T., M.Cs
* **Ketua Kelompok:** Adrian Septiaji (3312501064)
* **Anggota 1:** Cindo Maulina (3312501070)
* **Anggota 2:** Taqiyyah Aufaa Nabiilah (3312501084)

## 🚀 Fitur Utama

Sistem ini mendukung dua hak akses pengguna (Aktor), yaitu **Admin Gudang** dan **Manajer**, dengan fitur-fitur meliputi:
* **Manajemen Data Barang:** Mencatat dan memperbarui informasi produk atau barang di gudang.
* **Pencatatan Barang Masuk:** Mengelola data inventaris yang baru disuplai ke dalam gudang.
* **Pencatatan Barang Keluar:** Mengelola dan melacak data barang yang dikeluarkan dari gudang.
* **Monitoring Stok & Laporan:** Menampilkan jumlah persediaan secara *real-time* dan mencetak laporan persediaan barang. Khusus Manajer dapat melihat rincian stok dan mengunduh laporan tanpa akses manipulasi data teknis.
* **Manajemen Supplier & Kategori:** Mengelola informasi pemasok barang dan kategori elektronik terkait.

## 🛠️ Teknologi yang Digunakan

Proyek ini dibangun menggunakan *framework* dan teknologi web modern:
* **Framework PHP:** Laravel
* **Frontend:** HTML, CSS, JavaScript, Tailwind CSS, Blade Templating
* **Database:** MySQL

## ⚙️ Cara Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di lingkungan *local*:

1.  **Clone repositori ini:**
    ```bash
    git clone [https://github.com/adriansa2009/pro-web.git](https://github.com/adriansa2009/pro-web.git)
    cd pro-web
    ```
2.  **Instal dependensi PHP melalui Composer:**
    ```bash
    composer install
    ```
3.  **Instal dependensi NPM:**
    ```bash
    npm install
    npm run build
    ```
4.  **Salin file `.env` dan atur konfigurasi database:**
    ```bash
    cp .env.example .env
    ```
    *(Sesuaikan kredensial `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` dengan database lokal Anda)*
5.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```
6.  **Jalankan migrasi database (dan *seeder* jika ada):**
    ```bash
    php artisan migrate --seed
    ```
7.  **Jalankan server lokal:**
    ```bash
    php artisan serve
    ```
8.  Buka browser dan akses aplikasi melalui `http://localhost:8000`.

## 📄 Lisensi dan Hak Cipta

© 2026 Jurusan Teknik Informatika, Politeknik Negeri Batam. Seluruh hak cipta dari produk dan *source code* dilindungi sebagai bagian dari luaran proyek PBL Politeknik Negeri Batam.
