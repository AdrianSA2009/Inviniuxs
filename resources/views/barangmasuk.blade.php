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
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <div class="text-[10px] uppercase text-slate-500 font-bold pt-6 pb-2 px-4 tracking-widest">Master Data</div>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-tags w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Kategori</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-box w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Barang</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-truck w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Supplier</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all group">
                <i class="fas fa-box w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Pengguna</span>
            </a>

            <div class="text-[10px] uppercase text-slate-500 font-bold pt-6 pb-2 px-4 tracking-widest">Transaksi</div>
            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-xl text-white shadow-lg shadow-blue-900/20 transition-all duration-300">
                <i class="fas fa-arrow-down-long w-5 text-center text-green-500"></i>
                <span>Barang Masuk</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white glass-hover transition-all">
                <i class="fas fa-arrow-up-long w-5 text-center text-orange-500"></i>
                <span>Barang Keluar</span>
            </a>
        </nav>
        <!-- End Menu Navigasi -->

        <div class="px-4 py-1 border-t border-slate-700">
            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-red-600 rounded-xl text-slate-400 hover:text-white transition-all">
                <i class="fas fa-power-off w-5 text-center"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>
    <!-- End Sidebar -->

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