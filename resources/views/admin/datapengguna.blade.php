<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - Admin</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }

        .sidebar-nav::-webkit-scrollbar { width: 0px; background: transparent; }
        
        .glass-hover:hover {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    @include('layout.sidebar')
    <!-- End Sidebar -->

    <div class="flex-1 flex flex-col w-full md:ml-72 overflow-hidden transition-all duration-300">
        <!-- Top Navbar -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 flex items-center justify-between px-8 py-4 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <i class="fas fa-bars text-xl text-slate-600"></i>
                </button>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Pengguna</h2>
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
            <!-- Komponen Atas -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <span>Master Data</span>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Data Pengguna</span>
                    </nav>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Pengguna</h2>
                </div>
                <button data-modal-target="modalTambahUser" data-modal-toggle="modalTambahUser" class="flex items-center gap-2 px-6 py-3 bg-blue-600 rounded-xl text-white font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Pengguna</span>
                </button>
            </div>
        
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <div class="relative w-full group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400 text-sm" placeholder="Cari nama pengguna...">
                </div>
            </div>
            <!-- End Komponen Atas -->
            
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Nama</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Username</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Jabatan</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-6 py-4 font-bold text-slate-800">Cindo Maulina</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">cindo.ma</span>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-700">Manajer</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button data-modal-target="modalEdit" data-modal-toggle="modalEdit" class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button data-modal-target="modalDelete" data-modal-toggle="modalDelete" class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-6 py-4 font-bold text-slate-800">Adrian Spetiaji</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-600 text-xs font-semibold">adrian.sa</span>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-700">Admin Gudang</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openEditModal('Adrian Spetiaji', 'adrian.sa', 'Admin Gudang')" class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button data-modal-target="modalDelete" data-modal-toggle="modalDelete" class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-slate-500">Menampilkan 1-10 dari 1,245 Pengguna</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm">Previous</button>
                        <button class="w-8 h-8 bg-blue-600 text-white rounded-lg text-sm font-bold">1</button>
                        <button class="w-8 h-8 hover:bg-slate-100 text-slate-600 rounded-lg text-sm transition-all">2</button>
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm">Next</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambahUser" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div id="closeModalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
                <div class="bg-slate-900 px-8 py-6 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold tracking-tight">Tambah Pengguna Baru</h3>
                    <button type="button" data-modal-hide="modalTambahUser" data-modal-hide="modalTambah" class="text-slate-400 hover:text-white" data-modal-hide="modalTambahUser">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="p-8 space-y-4">
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                        <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan nama..." required>
                    </div>
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Username</label>
                        <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Contoh: adrian.sa" required>
                    </div>
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Password</label>
                        <input type="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jabatan</label>
                        <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="Admin">Admin Gudang</option>
                            <option value="Manajer">Manajer</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button data-modal-hide="modalTambahUser" type="button" class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl font-bold">Batal</button>
                        <button type="submit" class="flex-1 py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah -->

    <!-- Modal Edit -->
    <div id="modalEdit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div id="closeModalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
                <div class="bg-amber-500 px-8 py-6 text-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-edit"></i>
                        <h3 class="text-lg font-bold tracking-tight">Edit Data Pengguna</h3>
                    </div>
                    <button type="button" data-modal-hide="modalEdit" class="text-amber-100 hover:text-white" data-modal-hide="modalEditUser">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="p-8 space-y-4">
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                        <input type="text" id="edit-nama" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan Nama.." required>
                    </div>
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Username</label>
                        <input type="text" id="edit-username" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all" placeholder="Contoh: adrian.sa" required>
                    </div>
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Password Baru (Opsional)</label>
                        <input type="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all" placeholder="Kosongkan jika tidak diubah">
                    </div>
                    <div>
                        <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jabatan</label>
                        <select id="edit-jabatan" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all">
                            <option value="Admin Gudang">Admin Gudang</option>
                            <option value="Manajer">Manajer</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button data-modal-hide="modalEdit" type="button" class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl font-bold">Batal</button>
                        <button type="submit" class="flex-1 py-3 bg-amber-500 text-white rounded-xl font-bold shadow-lg shadow-amber-200">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Edit -->

    <!-- Modal Delete -->
    <div id="modalDelete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div id="closeDeleteOverlay" class="fixed inset-0 bg-red-900/20 backdrop-blur-sm transition-opacity"></div>
        <div class="animate-modal relative bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden text-center border-4 border-red-50">
            <div class="p-10">
                <div class="relative w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-75"></div>
                    <i class="fas fa-trash-alt text-4xl text-red-600 relative"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-3">Hapus Data?</h3>
                <p class="text-slate-500 text-sm mb-8">Data akan dihapus secara permanen dari database.</p>
            
                <div class="space-y-3">
                    <button id="confirmDeleteBtn" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 hover:scale-[1.02] transition-all shadow-lg shadow-red-200">
                        Ya, Hapus Sekarang
                    </button>
                    <button data-modal-hide="modalDelete" class="w-full py-4 bg-white text-slate-400 rounded-2xl font-bold hover:text-slate-600 transition-all">
                        Cancel Action
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-in-out'
        });
        
    const sidebar = document.getElementById('sidebar-multi-level-sidebar');
    const customOverlay = document.getElementById('sidebar-overlay-custom');

    const observer = new MutationObserver(() => {
        const isOpened = !sidebar.classList.contains('-translate-x-full');
        
        if (isOpened) {
            customOverlay.classList.remove('hidden');
        } else {
            customOverlay.classList.add('hidden');
        }
    });

    observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });

    </script>
</body>
</html>