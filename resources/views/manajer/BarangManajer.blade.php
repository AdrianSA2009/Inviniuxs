<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Admin</title>
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
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6 bg-slate-50">
            <!-- Komponen Atas Tabel -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <span>Master Data</span>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Data Barang</span>
                    </nav>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Inventaris</h2>
                </div>
                <button data-modal-target="modalExport" data-modal-toggle="modalExport" class="flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-600 font-semibold hover:bg-slate-50 transition-all shadow-sm">
                        <i class="fas fa-file-export"></i>
                        <span>Export</span>
                </button>
            </div>
        
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex flex-wrap gap-4 items-center justify-between">
                <div class="relative w-full md:w-96 group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" 
                        class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400 text-sm" 
                        placeholder="Cari nama barang...">
                </div>
                
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="relative flex-1 md:w-52">
                        <select class="w-full appearance-none px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-600 text-sm font-medium cursor-pointer transition-all pr-10">
                            <option value="">Semua Jenis</option>
                            <option value="kulkas">Kulkas</option>
                            <option value="kipas">Kipas</option>
                            <option value="kompor">Kompor</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                    
                    <button class="p-2.5 bg-slate-50 text-slate-500 border border-slate-200 rounded-xl hover:bg-white hover:text-blue-600 hover:border-blue-200 hover:shadow-sm transition-all active:scale-95">
                        <i class="fas fa-sliders text-sm"></i>
                    </button>
                </div>
            </div>
            <!-- End Komponen Atas Tabel -->
        
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Nama Barang</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Jenis Barang</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Harga</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Stok</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-6 py-4 font-bold text-slate-800">LG GN-B372SQBK 312L Inverter</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">Kulkas</span>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-700">Rp 7.499.900</td>
                                <td class="px-6 py-4 text-slate-700 font-semibold">12 Unit</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button data-modal-target="modalDetail" data-modal-toggle="modalDetail" class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-6 py-4 font-bold text-slate-800">Samsung Kulkas 2 Pintu RT47 465L</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-600 text-xs font-semibold">Kulkas</span>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-700">Rp 8.299.000</td>
                                <td class="px-6 py-4 text-slate-700 font-semibold">3 Unit</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button data-modal-target="modalDetail" data-modal-toggle="modalDetail" class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
                <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-slate-500">Menampilkan 1-10 dari 1,245 barang</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm">Previous</button>
                        <button class="w-8 h-8 bg-blue-600 text-white rounded-lg text-sm font-bold">1</button>
                        <button class="w-8 h-8 hover:bg-slate-100 text-slate-600 rounded-lg text-sm transition-all">2</button>
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm">Next</button>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div id="modalDetail" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div id="closeModalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-200">

                        <div class="bg-white px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-slate-800">
                                <i class="fas fa-file-alt text-blue-600 mr-2"></i> Rincian Inventaris
                            </h3>
                            <button data-modal-hide="modalDetail" class="text-slate-400 hover:text-slate-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    
                        <div class="px-6 py-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Nama Barang</label>
                                    <p id="detailNama" class="text-lg font-bold text-slate-900">LG GN-B372SQBK 312L Inverter</p>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Harga Satuan</label>
                                    <p id="detailHarga" class="text-lg font-bold text-blue-600">Rp 7.499.900</p>
                                </div>
                            </div>
                        
                            <div>
                                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Deskripsi Spesifikasi</label>
                                <p class="text-sm text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100 leading-relaxed">
                                    Kulkas 2 pintu 312L berwarna Dark Graphite Steel, kulkas ini memiliki fitur Multi Air Flow untuk pendinginan merata, Moist Balance Crisper untuk kesegaran sayur, dan rak Tempered Glass.
                                </p>
                            </div>
                        
                            <div>
                                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-2 text-blue-600">Daftar Unit Tersedia</label>
                                <div class="border border-slate-100 rounded-xl overflow-hidden">
                                    <table class="w-full text-sm text-left">
                                        <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                                            <tr>
                                                <th class="px-4 py-2.5 w-12 text-center">No</th>
                                                <th class="px-4 py-2.5">Kode Barang (SKU/SN)</th>
                                                <th class="px-4 py-2.5">Nama Barang</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 text-slate-700">
                                            <tr class="hover:bg-slate-50/50">
                                                <td class="px-4 py-3 text-center">1</td>
                                                <td class="px-4 py-3 font-mono text-xs text-blue-600 font-bold">904KRZP12345</td>
                                                <td class="px-4 py-3">LG GN-B372SQBK 312L Inverter</td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/50">
                                                <td class="px-4 py-3 text-center">2</td>
                                                <td class="px-4 py-3 font-mono text-xs text-blue-600 font-bold">108KRAA67890</td>
                                                <td class="px-4 py-3">LG GN-B372SQBK 312L Inverter</td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/50">
                                                <td class="px-4 py-3 text-center">3</td>
                                                <td class="px-4 py-3 font-mono text-xs text-blue-600 font-bold">203KRBK00112</td>
                                                <td class="px-4 py-3">LG GN-B372SQBK 312L Inverter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                            <button data-modal-hide="modalDetail" class="px-6 py-2 bg-white border border-slate-200 rounded-xl text-slate-600 text-sm font-bold hover:bg-slate-100 transition-all">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Detail -->

            <!-- Modal Export -->
            <div id="modalExport" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
                <div id="closeExportOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity"></div>

                <div class="animate-export relative bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100 flex flex-col">
                    <div class="bg-slate-900 px-8 py-6 text-white flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/20">
                                <i class="fas fa-file-excel text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold">Export to Excel</h2>
                                <p class="text-slate-400 text-xs mt-0.5">Filter dan pilih kategori untuk diunduh</p>
                            </div>
                        </div>
                        <button data-modal-hide="modalExport" class="text-slate-400 hover:text-white transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                
                    <form id="formExport" class="p-8">
                        <div class="mb-6 relative group">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Cari Kategori</label>
                            <div class="relative">
                                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-green-500 transition-colors"></i>
                                <input type="text" id="searchCategory" placeholder="Ketik nama kategori (ex: Kulkas, Kipas...)" 
                                    class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all outline-none text-sm font-medium text-slate-700">
                            </div>
                        </div>

                        <!-- Kategori Export -->
                        <div id="categoryGrid" class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                            <label class="category-item relative cursor-pointer group">
                                <input type="radio" name="exportCategory" value="all" class="peer hidden" checked>
                                <div class="p-4 rounded-2xl border-2 border-slate-50 bg-slate-50 text-slate-600 font-bold text-[11px] transition-all peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 group-hover:bg-slate-100 flex items-center">
                                    <i class="fas fa-globe-asia mr-3 text-lg opacity-50"></i> 
                                    <span class="category-name">Semua Data</span>
                                </div>
                            </label>
                        
                            <label class="category-item relative cursor-pointer group">
                                <input type="radio" name="exportCategory" value="kulkas" class="peer hidden">
                                <div class="p-4 rounded-2xl border-2 border-slate-50 bg-slate-50 text-slate-600 font-bold text-[11px] transition-all peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 group-hover:bg-slate-100 flex items-center">
                                    <i class="fas fa-laptop mr-3 text-lg opacity-50"></i> <span class="category-name">Kulkas</span>
                                </div>
                            </label>
                        </div>
                        <!-- End Kategori Export -->

                        <div id="noResult" class="hidden py-10 text-center">
                            <i class="fas fa-search text-slate-200 text-4xl mb-3"></i>
                            <p class="text-slate-400 text-sm">Kategori tidak ditemukan...</p>
                        </div>
                    
                        <div class="mt-8 flex gap-3">
                            <button type="submit" class="w-full py-4 bg-green-600 text-white rounded-2xl font-bold hover:bg-green-700 shadow-lg shadow-green-200 transition-all flex items-center justify-center gap-3">
                                <i class="fas fa-file-download"></i> Generate Excel Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Modal Export -->
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

        // Pencarian kategori pada modal
        document.getElementById('searchCategory').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const categories = document.querySelectorAll('.category-item');
            const noResult = document.getElementById('noResult');
            let hasMatch = false;
        
            categories.forEach(item => {
                const categoryName = item.querySelector('.category-name').innerText.toLowerCase();

                if (categoryName.includes(searchTerm)) {
                    item.classList.remove('hidden');
                    hasMatch = true;
                } else {
                    item.classList.add('hidden');
                }
            });
        
            if (hasMatch) {
                noResult.classList.add('hidden');
            } else {
                noResult.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>