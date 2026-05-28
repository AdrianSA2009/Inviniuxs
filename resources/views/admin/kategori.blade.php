<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori - Admin</title>
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
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 flex items-center justify-between px-8 py-4 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <i class="fas fa-bars text-xl text-slate-600"></i>
                </button>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Kategori inventaris</h2>
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

        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6 bg-slate-50">
            <!-- Alert Messages -->
            @if ($message = Session::get('success'))
                <div class="bg-green-50 border border-green-200 rounded-2xl p-4 flex items-center gap-3 animate-slide-in">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600 flex-shrink-0">
                        <i class="fas fa-check text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 font-semibold text-sm">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-green-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="bg-red-50 border border-red-200 rounded-2xl p-4 flex items-center gap-3 animate-slide-in">
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600 flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-red-800 font-semibold text-sm">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-red-400 hover:text-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <span>Master Data</span>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Data Kategori</span>
                    </nav>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Kategori Inventaris</h2>
                </div>
                <button data-modal-target="modalTambahKategori" data-modal-toggle="modalTambahKategori" class="flex items-center gap-2 px-6 py-3 bg-blue-600 rounded-xl text-white font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Kategori</span>
                </button>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <div class="relative w-full group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" id="searchInput" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400 text-sm" placeholder="Cari nama kategori...">
                </div>
            </div>

            <div class="bg-white rounded-[24px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    @if($kategoris->count() > 0)
                    <table class="w-full text-left border-collapse" id="kategoriTable">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-10 py-5 text-[11px] uppercase tracking-[0.15em] font-bold text-slate-400 text-center w-28">NO</th>
                                <th class="px-10 py-5 text-[11px] uppercase tracking-[0.15em] font-bold text-slate-400">NAMA KATEGORI</th>
                                <th class="px-10 py-5 text-[11px] uppercase tracking-[0.15em] font-bold text-slate-400 text-center w-48">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($kategoris as $index => $kategori)
                            <tr class="kategori-row group hover:bg-slate-50/50 transition-all">
                                <td class="px-10 py-6 text-slate-500 font-bold text-center text-sm">{{ $index + 1 }}</td>
                                <td class="px-10 py-6 font-bold text-[15px] kategori-nama">{{ $kategori->nama }}</td>
                                <td class="px-10 py-6">
                                    <div class="flex items-center justify-center gap-5">
                                        <button data-modal-target="modalEdit" data-modal-toggle="modalEdit" onclick="editKategori({{ $kategori->id }}, '{{ $kategori->nama }}')" class="text-slate-500 hover:text-blue-600 transition-colors">
                                            <i class="fas fa-edit text-lg"></i>
                                        </button>
                                        <button data-modal-target="modalDelete" data-modal-toggle="modalDelete" onclick="deleteKategori({{ $kategori->id }}, '{{ $kategori->nama }}')" class="text-slate-500 hover:text-red-500 transition-colors">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-3xl text-slate-400"></i>
                        </div>
                        <p class="text-slate-500 font-semibold mb-2">Belum ada data kategori</p>
                        <p class="text-slate-400 text-sm mb-6">Mulai tambahkan kategori baru untuk mengorganisir inventaris Anda</p>
                        <button data-modal-target="modalTambahKategori" data-modal-toggle="modalTambahKategori" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 rounded-xl text-white font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Kategori Pertama</span>
                        </button>
                    </div>
                    @endif
                </div>

                @if($kategoris->count() > 0)
                <div class="px-10 py-6 bg-slate-50/50 flex flex-col md:flex-row justify-between items-center gap-6">
                    <p class="text-sm text-slate-500 font-bold">Menampilkan {{ $kategoris->count() }} dari {{ $kategoris->count() }} kategori</p>
                </div>
                @endif
            </div>
        </main> 
    </div>

    <!-- Modal Delete -->
    <div id="modalDelete" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div id="closeDeleteOverlay" class="fixed inset-0 bg-red-900/20 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden text-center border-4 border-red-50 mx-auto">
            <div class="p-10">
                <div class="relative w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-75"></div>
                    <i class="fas fa-trash-alt text-4xl text-red-600 relative"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-3">Hapus Data?</h3>
                <p class="text-slate-500 text-sm mb-2">Kategori: <span id="deleteKategoriName" class="font-bold text-slate-700"></span></p>
                <p class="text-slate-500 text-sm mb-8">Data akan dihapus secara permanen.</p>
                <div class="space-y-3">
                    <form id="deleteForm" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button onclick="document.getElementById('deleteForm').submit()" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">Ya, Hapus Sekarang</button>
                    <button data-modal-hide="modalDelete" class="w-full py-4 bg-white text-slate-400 rounded-2xl font-bold hover:text-slate-600 transition-all">Cancel Action</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->

    <!-- Modal Tambah -->
    <div id="modalTambahKategori" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-[2px]">
        <div class="relative w-full max-w-md transition-all transform">
            <div class="relative bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100">

                <div class="flex items-start justify-between p-6 pb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white text-lg shadow-lg shadow-blue-200">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 tracking-tight">Kategori Baru</h3>
                            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">Tambahkan jenis barang</p>
                        </div>
                    </div>
                    <button type="button" data-modal-hide="modalTambahKategori" class="text-slate-300 hover:text-slate-900 transition-all">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-6 pt-2">
                    @csrf
                    <div class="mb-6">
                        <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em] ml-1">Nama Kategori</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <i class="fas fa-tag text-xs"></i>
                            </div>
                            <input type="text" name="nama" 
                                   placeholder="Contoh : Kulkas" 
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm text-slate-700 font-semibold placeholder:text-slate-300 @error('nama') border-red-500 @enderror">
                            @error('nama')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" data-modal-hide="modalTambahKategori" class="flex-1 py-3 bg-slate-50 text-slate-500 rounded-2xl font-bold hover:bg-slate-100 transition-all text-xs">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 py-3 bg-blue-600 text-white rounded-2xl font-bold shadow-md shadow-blue-100 hover:bg-blue-700 transition-all text-xs tracking-wide">
                            Tambah Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah -->

    <!-- Modal Edit -->
    <div id="modalEdit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-900/30 backdrop-blur-sm"></div>

            <div class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden border border-slate-100">

                <div class="flex items-start justify-between p-7 pb-6">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center text-white text-xl shadow-lg shadow-amber-200">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Edit Kategori</h3>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Perbarui informasi kategori barang</p>
                        </div>
                    </div>
                    <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-10 h-10 inline-flex justify-center items-center transition-all" data-modal-hide="modalEdit">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <div class="border-b border-slate-100"></div>

                <form id="editForm" method="POST" class="p-8">
                    @csrf
                    @method('PUT')
                    <div class="mb-8">
                        <label class="block mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] ml-1">Nama Kategori</label>

                        <input type="text" id="editNamaInput" name="nama" 
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all outline-none text-slate-700 font-semibold placeholder:text-slate-300 @error('nama') border-red-500 @enderror">
                        @error('nama')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-center gap-4">
                        <button type="button" data-modal-hide="modalEdit" class="px-10 py-3.5 bg-slate-100 text-slate-700 rounded-xl font-bold hover:bg-slate-200 transition-all text-sm tracking-tight flex-1">
                            Batal
                        </button>

                        <button type="submit" class="px-10 py-3.5 bg-amber-500 text-white rounded-xl font-bold shadow-lg shadow-amber-200 hover:bg-amber-600 transition-all text-sm tracking-tight flex-1">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Edit -->

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

        // Edit function
        function editKategori(id, nama) {
            document.getElementById('editNamaInput').value = nama;
            const editForm = document.getElementById('editForm');
            editForm.action = `/admin/kategori/${id}`;
        }

        // Delete function
        function deleteKategori(id, nama) {
            document.getElementById('deleteKategoriName').textContent = nama;
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/kategori/${id}`;
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#kategoriTable tbody tr');
            
            tableRows.forEach(row => {
                const namaKategori = row.querySelector('.kategori-nama').textContent.toLowerCase();
                if (namaKategori.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>