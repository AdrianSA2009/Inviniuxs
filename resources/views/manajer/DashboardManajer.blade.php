<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manajer</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }

        .sidebar-nav::-webkit-scrollbar { width: 0px; background: transparent; }

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
    @include('layout.sidebar-manajer')
    <!-- End Sidebar -->

    <div class="flex-1 flex flex-col w-full md:ml-72 overflow-hidden transition-all duration-300">
        <!-- Top Navbar -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 flex items-center justify-between px-8 py-4 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <i class="fas fa-bars text-xl text-slate-600"></i>
                </button>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Inventaris</h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-bold text-slate-900">Manajer</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200">
                    M
                </div>
            </div>
        </header>
        <!-- End Top Navbar -->

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-8 bg-slate-50">
            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Total Barang</p>
                    <p class="text-3xl font-black text-slate-800">355</p>
                </div>

                <div data-aos="fade-up" data-aos-delay="200" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-xl group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-arrow-trend-down"></i>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Barang Masuk</p>
                    <p class="text-3xl font-black text-slate-800">120</p>
                </div>

                <div data-aos="fade-up" data-aos-delay="300" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-arrow-trend-up"></i>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Barang Keluar</p>
                    <p class="text-3xl font-black text-slate-800">67</p>
                </div>

                <div data-aos="fade-up" data-aos-delay="400" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Total Supplier</p>
                    <p class="text-3xl font-black text-slate-800">20</p>
                </div>
            </div>
            <!-- End Cards -->

            <!-- Aktivitas Terakhir -->
            <div data-aos="fade-up" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50">
                    <h3 class="text-lg font-bold text-slate-800">Aktivitas Terakhir</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                            <tr>
                                <th class="px-6 py-4">Kode Transaksi</th>
                                <th class="px-6 py-4">Nama Barang</th>
                                <th class="px-6 py-4">Tipe Transaksi</th>
                                <th class="px-6 py-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover-row">
                                <td class="px-6 py-4 font-mono text-xs text-blue-600 font-bold">BRGN-001</td>
                                <td class="px-6 py-4 font-medium text-slate-700">Samsung Kulkas 2 Pintu RT47 465L</td>
                                <td class="px-6 py-4">Barang Masuk</td>
                                <td class="px-6 py-4 text-slate-500">12 Maret 2026, 14:20</td>
                            </tr>
                            <tr class="hover-row">
                                <td class="px-6 py-4 font-mono text-xs text-blue-600 font-bold">BRGO-042</td>
                                <td class="px-6 py-4 font-medium text-slate-700">LG GN-B202SQIB 2 Pintu 202L</td>
                                <td class="px-6 py-4">Barang Keluar</td>
                                <td class="px-6 py-4 text-slate-500">12 Maret 2026, 11:05</td>
                            </tr>
                            <tr class="hover-row">
                                <td class="px-6 py-4 font-mono text-xs text-blue-600 font-bold">BRGN-015</td>
                                <td class="px-6 py-4 font-medium text-slate-700">LG GN-B372SQBK 312L Inverter</td>
                                <td class="px-6 py-4">Barang Masuk</td>
                                <td class="px-6 py-4 text-slate-500">11 Maret 2026, 16:45</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Aktivitas Terakhir -->
        </main>
        <!-- End Main Content -->
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-in-out'
        });
    </script>
</body>
</html>