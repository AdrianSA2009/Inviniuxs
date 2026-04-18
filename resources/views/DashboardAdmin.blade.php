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
    <aside id="sidebar" class="bg-slate-900 text-white w-72 flex-shrink-0 hidden md:flex flex-col transition-all duration-300 z-30 absolute md:relative h-full shadow-2xl">
        <div class="p-6 flex items-center gap-3 border-b border-slate-700">
            <div class="bg-blue-600 p-2 rounded-lg">
                <i class="fas fa-laptop-code text-white"></i>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Inviniux</h1>
            <button id="closeSidebar" class="md:hidden ml-auto text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Menu Navigasi -->
        <nav class="sidebar-nav flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('dashboardadmin') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-xl text-white shadow-lg shadow-blue-900/20 transition-all duration-300">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <div class="text-[10px] uppercase text-slate-500 font-bold pt-6 pb-2 px-4 tracking-widest">Master Data</div>
            <a href="{{ route('kategori') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-tags w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Kategori</span>
            </a>
            <a href="{{ route('brgadmin') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-box w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Barang</span>
            </a>
            <a href="{{ route('supplier') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-truck w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Supplier</span>
            </a>
            <a href="{{ route('pengguna') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-users w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Pengguna</span>
            </a>

            <div class="text-[10px] uppercase text-slate-500 font-bold pt-6 pb-2 px-4 tracking-widest">Transaksi</div>
            <a href="{{ route('barang-masuk') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all">
                <i class="fas fa-arrow-down-long w-5 text-center text-green-500"></i>
                <span>Barang Masuk</span>
            </a>
            <a href="{{ route('barang-keluar') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all">
                <i class="fas fa-arrow-up-long w-5 text-center text-orange-500"></i>
                <span>Barang Keluar</span>
            </a>
        </nav>
        
        <div class="p-4 border-t border-slate-700">
            <a href="../login.html" class="flex items-center text-slate-400 gap-3 px-4 hover:text-white transition-all">
                <i class="fas fa-power-off w-5 text-center"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
        <!-- End Menu Navigasi -->
    </aside>
    <!-- End Sidebar -->

    <div class="flex-1 flex flex-col w-full overflow-hidden">
        <!-- Top Navbar -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 flex items-center justify-between px-8 py-4 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <button id="openSidebar" class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <i class="fas fa-bars text-xl text-slate-600"></i>
                </button>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Dashboard Overview</h2>
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