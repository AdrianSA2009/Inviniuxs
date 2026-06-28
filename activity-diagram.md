# Sequence Diagram - Pro Web (Inventory Management)

## Alur Login & Autentikasi

```mermaid
sequenceDiagram
    actor U as User
    participant B as Browser
    participant DB as Database

    U->>B: Buka aplikasi
    B->>DB: Cek session
    DB-->>B: Session valid?
    alt Tidak login
        B-->>U: Tampilkan form login
        U->>B: Input username & password
        B->>DB: Validasi kredensial
        alt Gagal
            DB-->>B: Kredensial salah
            B-->>U: Tampilkan error
        else Berhasil
            B->>DB: Simpan session
            alt admin_gudang
                B-->>U: Redirect ke /admin/
            else manajer
                B-->>U: Redirect ke /manajer/
            end
        end
    else Ya login
        B-->>U: Redirect ke dashboard
    end
```

## Dashboard Admin Gudang

```mermaid
sequenceDiagram
    actor Admin as Admin Gudang
    participant B as Browser
    participant DB as Database

    Admin->>B: Buka dashboard
    B->>DB: COUNT UnitBarang (keluar=null)
    DB-->>B: Total barang
    B->>DB: COUNT BarangMasuk
    DB-->>B: Total masuk
    B->>DB: COUNT BarangKeluar
    DB-->>B: Total keluar
    B->>DB: COUNT Supplier
    DB-->>B: Total supplier
    B->>DB: 3 aktivitas terakhir (BM+BK, desc)
    DB-->>B: Aktivitas
    B-->>Admin: Tampilkan 4 kartu + aktivitas
```

## Master Barang (Admin)

```mermaid
sequenceDiagram
    actor Admin as Admin Gudang
    participant B as Browser
    participant DB as Database

    Admin->>B: Buka halaman barang
    B->>DB: Query semua barang + relasi
    DB-->>B: Data barang
    B->>B: Group by nama, filter stok>0, paginate 10
    B-->>Admin: Tampilkan tabel + filter kategori

    alt Update barang
        Admin->>B: Klik edit (modal)
        B->>B: Form edit
        Admin->>B: Submit form
        B->>B: Validasi: nama unik, harga>0, kategori valid
        alt Upload gambar
            B->>B: Hapus gambar lama
            B->>B: Simpan gambar baru
        end
        B->>DB: Update data barang
        DB-->>B: Sukses/gagal
        B-->>Admin: Toast notifikasi
    else Export Excel
        Admin->>B: Pilih barang/kategori
        B->>DB: Query barang + UnitBarang
        DB-->>B: Data
        B->>B: Generate spreadsheet
        B-->>Admin: Download .xlsx
    end
```

## Barang Masuk (Stock In)

```mermaid
sequenceDiagram
    actor Admin as Admin Gudang
    participant B as Browser
    participant DB as Database
    participant P as Pusher

    Admin->>B: Buka halaman barang masuk
    B->>DB: Query semua transaksi masuk
    DB-->>B: Data
    B-->>Admin: Tabel + modal form

    alt Tambah
        Admin->>B: Pilih kategori & supplier
        Admin->>B: Input nama barang, tanggal, serial numbers
        B->>DB: Validasi serial number (duplikat? sudah ada?)
        alt SN duplikat
            DB-->>B: Duplikat ditemukan
            B-->>Admin: Error: SN duplikat
        else SN sudah terdaftar
            DB-->>B: SN sudah ada
            B-->>Admin: Error: SN sudah ada
        else OK
            B->>DB: Generate kode IN-YYYYMMDD-NNN
            B->>DB: Simpan transaksi + UnitBarang
            B->>DB: Sync stok (hitung unit aktual)
            DB-->>B: Stok <= 3?
            alt Stok <= 3
                B->>DB: Buat LowStockAlert
                B->>P: Broadcast notif
                P-->>B: Real-time notif
            else Stok > 3
                B->>DB: Hapus LowStockAlert unread
            end
            B-->>Admin: Redirect + toast sukses
        end
    else Edit
        Admin->>B: Klik edit transaksi
        B->>DB: Load transaksi + unit existing
        DB-->>B: Data
        B-->>Admin: Form edit
        Admin->>B: Edit kategori/nama/supplier/tanggal/SN
        B->>DB: Cek unit berubah?
        alt Unit terkunci & diubah
            DB-->>B: Unit sudah keluar
            B-->>Admin: Error: unit sudah tercatat keluar
        else OK
            B->>DB: Update/create/delete UnitBarang
            B->>DB: Sync stok semua barang
            B-->>Admin: Redirect + toast
        end
    else Hapus
        Admin->>B: Klik hapus transaksi
        B->>DB: Cek ada unit sudah keluar?
        alt Ada terkunci
            DB-->>B: Unit sudah keluar
            B-->>Admin: Error: tidak bisa hapus
        else Tidak ada
            B->>DB: Hapus UnitBarang
            B->>DB: Hapus transaksi
            B->>DB: Sync stok
            B-->>Admin: Redirect + toast
        end
    end
```

## Barang Keluar (Stock Out)

```mermaid
sequenceDiagram
    actor Admin as Admin Gudang
    participant B as Browser
    participant DB as Database

    Admin->>B: Buka halaman barang keluar
    B->>DB: Query semua transaksi keluar
    DB-->>B: Data
    B-->>Admin: Tabel + modal form

    alt Tambah
        Admin->>B: Input penerima, tanggal, serial numbers
        loop Setiap SN
            B->>DB: Validasi SN (ditemukan? tersedia?)
            alt SN tidak ditemukan
                DB-->>B: Unit invalid
                B-->>Admin: Error: unit tidak valid
            else Sudah keluar
                DB-->>B: Unit tidak tersedia
                B-->>Admin: Error: unit tidak tersedia
            end
        end
        B->>DB: Generate kode OUT-YYYYMMDD-RANDOM
        B->>DB: Simpan transaksi
        B->>DB: Tandai unit (isi barang_keluar_id)
        B->>DB: Sync stok + cek low stock
        B-->>Admin: Redirect + toast sukses
    else Edit
        Admin->>B: Klik edit transaksi
        B->>DB: Load transaksi + unit terkait
        DB-->>B: Data
        B-->>Admin: Form edit
        Admin->>B: Edit penerima/tanggal/SN
        B->>DB: Lepas semua unit lama
        loop Validasi SN baru
            B->>DB: Cek SN sudah keluar?
            alt Ada yg terkunci
                B-->>Admin: Error
            end
        end
        B->>DB: Pasang unit baru
        B->>DB: Sync stok semua barang
        B-->>Admin: Redirect + toast
    else Hapus
        Admin->>B: Klik hapus transaksi
        B->>DB: Lepas barang_keluar_id dari units
        B->>DB: Hapus transaksi
        B->>DB: Sync stok
        B-->>Admin: Redirect + toast
    end
```

## CRUD Master Data

```mermaid
sequenceDiagram
    actor Admin as Admin Gudang
    participant B as Browser
    participant DB as Database

    rect rgb(200, 230, 200)
        Note over Admin,DB: Kategori
        Admin->>B: Buka halaman kategori
        B->>DB: Query semua kategori
        DB-->>B: Data
        B-->>Admin: Tabel kategori
        Admin->>B: Input nama kategori
        B->>DB: Simpan kategori
        DB-->>B: OK
        B-->>Admin: Reload tabel
    end

    rect rgb(200, 200, 230)
        Note over Admin,DB: Supplier
        Admin->>B: Buka halaman supplier
        B->>DB: Query semua supplier
        DB-->>B: Data
        B-->>Admin: Tabel supplier
        Admin->>B: Input nama, alamat, no telp
        B->>DB: Simpan supplier
        DB-->>B: OK
        B-->>Admin: Reload tabel
    end

    rect rgb(230, 200, 200)
        Note over Admin,DB: Pengguna
        Admin->>B: Buka halaman pengguna
        B->>DB: Query semua pengguna
        DB-->>B: Data
        B-->>Admin: Tabel pengguna
        Admin->>B: Input nama, username, email, password, role
        B->>B: Validasi data
        alt Gagal
            B-->>Admin: Error
        else OK
            B->>DB: Simpan pengguna
            DB-->>B: OK
            B-->>Admin: Reload tabel
        end
    end
```

## Notifikasi Real-time Low Stock

```mermaid
sequenceDiagram
    participant DB as Database
    participant P as Pusher
    participant B as Browser
    actor U as User

    rect rgb(255, 220, 220)
        Note over DB,U: Stok <= 3 unit
        DB-->>B: Stok rendah terdeteksi
        B->>DB: Buat LowStockAlert
        B->>P: Broadcast notifikasi
        P-->>B: Real-time event
        B-->>U: Tampilkan notif di navbar
        U->>B: Klik Read All
        B->>DB: UPDATE is_read=true, read_at=now
        DB-->>B: OK
        B-->>U: Notif dismissed
    end

    rect rgb(220, 255, 220)
        Note over DB,U: Stok > 3 unit (pulih)
        DB-->>B: Stok normal
        B->>DB: Hapus LowStockAlert unread
    end
```

## Dashboard Manajer

```mermaid
sequenceDiagram
    actor M as Manajer
    participant B as Browser
    participant DB as Database

    M->>B: Buka dashboard manajer
    B->>DB: Load ringkasan data
    DB-->>B: Data
    B-->>M: Tampilkan dashboard

    alt Lihat barang
        M->>B: Klik menu barang
        B->>DB: Query barang
        DB-->>B: Data
        B-->>M: Daftar barang
    else Export
        M->>B: Klik export
        B->>DB: Query barang + UnitBarang
        DB-->>B: Data
        B->>B: Generate Excel
        B-->>M: Download .xlsx
    end
```

## Hubungan Antar Modul

```mermaid
sequenceDiagram
    participant User as User/Karyawan
    participant B as Browser
    participant DB as Database
    participant P as Pusher

    User->>B: Login
    B->>DB: Cek session & validasi role

    alt admin_gudang
        B-->>User: Dashboard admin
        User->>B: Kelola barang
        User->>B: Barang masuk
        User->>B: Barang keluar
        User->>B: Atur kategori/supplier/pengguna

        Note over DB: Sinkronisasi stok
        B->>DB: Transaksi masuk/keluar
        B->>DB: Sync stok (hitung unit aktual)
        DB-->>B: Stok update
        alt Stok <= 3
            B->>DB: LowStockAlert
            B->>P: Broadcast
            P-->>B: Notif real-time
        end
    else manajer
        B-->>User: Dashboard manajer
        User->>B: Lihat barang (read-only)
        User->>B: Export Excel
    end
```

## Penjelasan Singkat

| Fitur | Aktor | Keterangan |
|-------|-------|------------|
| **Autentikasi** | Semua | Login session-based, throttle 5 percobaan/menit, redirect berdasarkan role |
| **Dashboard Admin** | Admin Gudang | 4 kartu statistik: total barang, barang masuk, barang keluar, supplier + 3 aktivitas terakhir |
| **Master Barang** | Admin Gudang | Lihat, edit barang (nama, harga, kategori, gambar), filter kategori, export Excel per barang/kategori |
| **Barang Masuk** | Admin Gudang | Catat penerimaan barang + serial number per unit. Auto-create barang jika nama+kategori baru. Generate kode IN-YYYYMMDD-NNN |
| **Barang Keluar** | Admin Gudang | Catat pengeluaran dengan scan serial number. Validasi ketersediaan unit. Generate kode OUT-YYYYMMDD-RANDOM |
| **Kategori** | Admin Gudang | CRUD kategori barang |
| **Supplier** | Admin Gudang | CRUD supplier (nama, alamat, no telp) |
| **Pengguna** | Admin Gudang | CRUD karyawan (nama, username, email, password, role) |
| **Dashboard Manajer** | Manajer | Lihat ringkasan read-only |
| **Barang Manajer** | Manajer | Lihat daftar barang + export Excel |
| **Low Stock Alert** | Semua (real-time) | Notifikasi stok ≤ 3 unit via Pusher. Broadcast + simpan ke DB. Dismiss via Read All |
| **Pengaturan** | Semua | Update profil (nama/username/email) dan password |

> **Catatan Arsitektur:**
> - Stok barang = hitungan aktual unit (`COUNT UnitBarang WHERE barang_keluar_id IS NULL`), bukan counter manual
> - Serial number bersifat unique secara global
> - Transaksi masuk/keluar yang sudah memiliki unit terkunci (sudah tercatat keluar) tidak bisa diedit/hapus
> - Export Excel menggunakan PhpSpreadsheet dengan grouping per nama barang + tabel ringkasan
