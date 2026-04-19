<aside id="sidebar-multi-level-sidebar" 
       data-drawer-backdrop="false" 
       class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full md:translate-x-0 bg-slate-900 text-white flex flex-col shadow-2xl" 
       aria-label="Sidebar">        <div class="p-6 flex items-center gap-3 border-b border-slate-700">
            <div class="bg-blue-600 p-2 rounded-lg">
                <i class="fas fa-laptop-code text-white"></i>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Inviniux</h1>
            <button data-drawer-hide="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" class="md:hidden ml-auto text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
    
        <nav class="sidebar-nav flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            
            {{-- Dashboard --}}
            <a href="{{ route('dashboardadmin') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboardadmin') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-white glass-hover' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <div class="text-[10px] uppercase text-slate-500 font-bold pt-6 pb-2 px-4 tracking-widest">Master Data</div>
            
            {{-- Data Kategori --}}
            <a href="{{ route('kategori') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('kategori') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white glass-hover' }}">
                <i class="fas fa-tags w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Kategori</span>
            </a>
    
            {{-- Data Barang --}}
            <a href="{{ route('brgadmin') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('brgadmin') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white glass-hover' }}">
                <i class="fas fa-box w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Barang</span>
            </a>
    
            {{-- Data Supplier --}}
            <a href="{{ route('supplier') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('supplier') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white glass-hover' }}">
                <i class="fas fa-truck w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Supplier</span>
            </a>
    
            {{-- Data Pengguna --}}
            <a href="{{ route('pengguna') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('pengguna') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white glass-hover' }}">
                <i class="fas fa-users w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span>Data Pengguna</span>
            </a>
    
            <div class="text-[10px] uppercase text-slate-500 font-bold pt-6 pb-2 px-4 tracking-widest">Transaksi</div>
            
            {{-- Barang Masuk --}}
            <a href="{{ route('barang-masuk') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('barang-masuk') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white glass-hover' }}">
                <i class="fas fa-arrow-down-long w-5 text-center {{ request()->routeIs('barang-masuk') ? 'text-white' : 'text-green-500' }}"></i>
                <span>Barang Masuk</span>
            </a>
    
            {{-- Barang Keluar --}}
            <a href="{{ route('barang-keluar') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('barang-keluar') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white glass-hover' }}">
                <i class="fas fa-arrow-up-long w-5 text-center {{ request()->routeIs('barang-keluar') ? 'text-white' : 'text-orange-500' }}"></i>
                <span>Barang Keluar</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-700">
            <a href="{{ route('logout') }}" class="flex items-center text-slate-400 gap-3 px-4 hover:text-white transition-all">
                <i class="fas fa-power-off w-5 text-center"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>

<div id="sidebar-overlay-custom" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 hidden"></div>