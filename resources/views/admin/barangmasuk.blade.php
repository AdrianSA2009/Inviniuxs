<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .sidebar-nav::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
        .sidebar-nav {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .glass-hover:hover {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        tr.hover-row:hover {
            background-color: #f8fafc;
            transition: all 0.2s;
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    @include('layout.sidebar')
    <!-- Sidebar -->

    <div class="flex-1 flex flex-col w-full md:ml-72 overflow-hidden transition-all duration-300">
        <!-- Top Navbar -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 flex items-center justify-between px-8 py-4 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" class="md:hidden p-2 rounded-lg hover:bg-slate-100">
                    <i class="fas fa-bars text-xl text-slate-600"></i>
                </button>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Transaksi</h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-bold text-slate-900">Admin Gudang</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200">
                    AG
                </div>
            </div>
        </header>
        <!-- End Top Navbar -->

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6 bg-slate-50">
            <!-- Bagian Atas -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <span>Transaksi</span>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Barang Masuk</span>
                    </nav>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Riwayat Barang Masuk</h2>
                </div>
                <button data-modal-target="modalTambahTransaksi" data-modal-toggle="modalTambahTransaksi" class="flex items-center gap-2 px-6 py-3 bg-blue-600 rounded-xl text-white font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Transaksi</span>
                </button>
            </div>
            <!-- End Bagian Atas -->

            <!-- Search -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <div class="relative w-full group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400 text-sm" placeholder="Cari nama barang...">
                </div>
            </div>
            <!-- End Search -->

            <!-- Tabel -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Kode Transaksi</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Nama Barang</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Jumlah</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Supplier</th>
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 font-bold text-slate-800 uppercase tracking-tight">IN-20260401-01</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">LG GN-B202SQIB 2 Pintu 202L</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">15 UNIT</td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">PT. Panasonic Gobel Indonesia</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-center gap-2">
                                        <button data-modal-target="modalDetail" data-modal-toggle="modalDetail" class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button data-modal-target="modalEdit" data-modal-toggle="modalEdit" class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button data-modal-target="modalDelete" data-modal-toggle="modalDelete" class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 font-bold text-slate-800 uppercase tracking-tight">IN-20260401-02</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">Samsung Kulkas 2 Pintu RT47 465L</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">8 UNIT</td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">PT. Samsung Electronics Indonesia</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-center gap-2">
                                        <button data-modal-target="modalDetail" data-modal-toggle="modalDetail" class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button data-modal-target="modalEdit" data-modal-toggle="modalEdit" class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button data-modal-target="modalDelete" data-modal-toggle="modalDelete" class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-slate-500">Menampilkan 1-2 dari 15 transaksi</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm">Previous</button>
                        <button class="w-8 h-8 bg-blue-600 text-white rounded-lg text-sm font-bold">1</button>
                        <button class="w-8 h-8 hover:bg-slate-100 text-slate-600 rounded-lg text-sm transition-all">2</button>
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm">Next</button>
                    </div>
                </div>
            </div>
            <!-- End Tabel -->
        </main>
        <!-- End Main Content -->
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambahTransaksi" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div id="closeModalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                <div class="flex items-start justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white text-xl shadow-lg shadow-blue-200">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Tambah Barang Masuk</h3>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Tambahkan transaksi barang masuk ke sistem</p>
                        </div>
                    </div>
                    <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition-colors" data-modal-hide="modalTambahTransaksi">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                <form class="p-8">
                    <div class="space-y-6 mb-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</label>
                            <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan nama barang lengkap (Contoh: Samsung Kulkas 2 Pintu RT47)" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Barang</label>
                                <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                                    <option value="" disabled selected>Pilih jenis barang</option>
                                    <option value="Kulkas">Kulkas</option>
                                    <option value="AC">AC</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">SUPPLIER</label>
                                <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                                    <option value="" disabled selected>Pilih Supplier</option>
                                    <option value="supplier1">PT. Panasonic Gobel Indonesia</option>
                                    <option value="supplier">PT. Samsung Electronics Indonesia</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Daftar Unit</label>
                            <button type="button" class="px-4 py-1.5 bg-blue-600 text-white text-[10px] font-black rounded-lg shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all uppercase tracking-wider">
                                Input
                            </button>
                        </div>
                        <div class="border border-slate-100 rounded-[2rem] overflow-hidden shadow-sm bg-white">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/80 border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center w-16">No</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Serial Number</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Barang</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4 text-center text-xs font-bold text-slate-400">1</td>
                                        <td class="px-6 py-4">
                                            <input type="text" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan serial number" required>
                                        </td>
                                        <td class="px-6 py-4 text-xs font-bold text-slate-700">
                                            <input type="text" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan nama barang" required> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <button data-modal-hide="modalTambahTransaksi" type="button" class="px-8 py-2.5 bg-slate-100 text-slate-500 rounded-xl font-bold hover:bg-slate-200 transition-all text-sm">
                            Batal
                        </button>
                        <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all text-sm uppercase">
                            Tambah Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah -->
    
    <!-- Modal Edit -->
    <div id="modalEdit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div id="closeModalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="flex items-start justify-between p-6">
                    <div class="flex items-center gap-4">
                        <div>
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest">Update Registry</span>
                            <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">Edit Barang Masuk</h2>
                        </div>
                    </div>
                    <button type="button" data-modal-hide="modalEdit" class="bg-slate-100 hover:bg-slate-200 text-slate-400 w-10 h-10 rounded-full transition-all flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form class="px-8 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</label>
                            <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" value="Panasonic NR-BB201 Q-S 2 Pintu" required>
                        </div>

                        <div>
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Barang</label>
                            <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                                <option value="Kulkas" selected>Kulkas</option>
                                <option value="AC">AC</option>
                            </select>
                        </div>
    
                        <div>
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Supplier</label>
                            <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                                <option value="PT. Panasonic Gobel Indonesia" selected>PT. Panasonic Gobel Indonesia</option>
                                <option value="PT. Samsung Electronics Indonesia">PT. Samsung Electronics Indonesia</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Daftar Unit</label>
                            <button type="button" class="px-4 py-1.5 bg-blue-600 text-white text-[10px] font-black rounded-lg shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all uppercase tracking-wider">
                                Input
                            </button>
                        </div>
                        
                        <div class="border border-slate-100 rounded-[2rem] overflow-hidden shadow-sm bg-white">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/80 border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center w-16">No</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Serial Number</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Barang</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4 text-center text-xs font-bold text-slate-400">1</td>
                                        <td class="px-6 py-4">
                                            <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" value="904KRZP12345" required>
                                        </td>
                                        <td class="px-6 py-4 text-xs font-bold text-slate-700">
                                            <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" value="Kulkas" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <button data-modal-hide="modalEdit" type="button" class="px-8 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all text-xs uppercase tracking-widest">
                            Tutup
                        </button>
                        <button type="submit" class="px-8 py-2.5 bg-black text-white rounded-xl font-bold hover:bg-slate-800 transition-all text-xs uppercase tracking-widest shadow-lg shadow-slate-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    <!-- End Modal Edit -->

    <!-- Modal Detail -->
    <div id="modalDetail" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div id="closeModalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>    
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
                <div class="flex items-center justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-sky-100">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Rincian Barang Masuk</h2>
                    </div>
                    <button type="button" data-modal-hide="modalDetail" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <form class="px-8 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</label>
                            <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" value="Panasonic NR-BB201 Q-S 2 Pintu" required>
                        </div>
        
                        <div>
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Barang</label>
                            <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                                <option value="Kulkas" selected>Kulkas</option>
                                <option value="AC">AC</option>
                            </select>
                        </div>
    
                        <div>
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Supplier</label>
                            <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                                <option value="PT. Panasonic Gobel Indonesia" selected>PT. Panasonic Gobel Indonesia</option>
                                <option value="PT. Samsung Electronics Indonesia">PT. Samsung Electronics Indonesia</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Daftar Unit</label>
                        </div>
                        <div class="border border-slate-100 rounded-[2rem] overflow-hidden shadow-sm bg-white">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/80 border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center w-16">No</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Serial Number</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Barang</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4 text-center text-xs font-bold text-slate-800">1</td>
                                        <td class="px-6 py-4">
                                            <span class="text-xs font-medium text-slate-800  px-3 py-1.5 rounded-lg uppercase tracking-tight">
                                                108KRAA67890
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-xs font-medium text-slate-800">
                                            LG GN-B372SQBK 312L Inverter
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>               

                    <div class="px-8 py-6 border-t border-slate-50 flex justify-end">
                        <button data-modal-hide="modalDetail" type="button" class="px-10 py-3 bg-white border-2 border-slate-100 text-slate-800 rounded-2xl font-bold hover:bg-slate-50 hover:border-slate-200 transition-all text-xs uppercase tracking-widest shadow-sm">
                            Tutup
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Detail -->

    <!-- Modal Delete -->
    <div id="modalDelete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div id="closeDeleteOverlay" class="fixed inset-0 bg-red-900/20 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden text-center border-4 border-red-50 mx-auto">
            <div class="p-10">
                <div class="relative w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-75"></div>
                    <i class="fas fa-trash-alt text-4xl text-red-600 relative"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-3">Hapus Data?</h3>
                <p class="text-slate-500 text-sm mb-8">Data akan dihapus secara permanen.</p>
                <div class="space-y-3">
                    <button class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">Ya, Hapus Sekarang</button>
                    <button data-modal-hide="modalDelete" class="w-full py-4 bg-white text-slate-400 rounded-2xl font-bold hover:text-slate-600 transition-all">Cancel Action</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-in-out'
        });

        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('hidden');
            overlay.classList.toggle('hidden');
        }

        openSidebarBtn.addEventListener('click', toggleSidebar);
        closeSidebarBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>