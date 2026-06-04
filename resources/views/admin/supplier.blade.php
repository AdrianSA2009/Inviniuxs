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
    @include('layout.partials.aos-head')
    
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
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Supplier</h2>
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
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4" data-aos="fade-down">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <span>Master Data</span>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Data Supplier</span>
                    </nav>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Supplier</h2>
                </div>
                <button data-modal-target="modalTambahSupplier" data-modal-toggle="modalTambahSupplier" class="flex items-center gap-2 px-6 py-3 bg-blue-600 rounded-xl text-white font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Supplier</span>
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-100">
                    <form action="{{ route('admin.supplier.index') }}" method="GET" class="relative w-full md:max-w-sm">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input name="search" value="{{ request('search') }}" type="text" class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold" placeholder="Cari nama, alamat, atau telepon">
                    </form>
                    <p class="text-sm text-slate-500">Menampilkan {{ $suppliers->count() }} dari {{ $suppliers->total() }} supplier</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">No</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Nama Supplier</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">No. HP</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400">Alamat</th>
                                <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($suppliers as $supplier)
                                <tr class="group hover:bg-slate-50/50 transition-all">
                                    <td class="px-6 py-4 text-slate-500 font-medium text-center text-sm">{{ $loop->iteration + ($suppliers->currentPage() - 1) * $suppliers->perPage() }}</td>
                                    <td class="px-6 py-4 text-slate-700 font-medium text-sm">{{ $supplier->nama }}</td>
                                    <td class="px-6 py-4 text-slate-600 font-medium text-sm">{{ $supplier->no_telp }}</td>
                                    <td class="px-6 py-4 text-slate-600 text-sm">{{ \Illuminate\Support\Str::limit($supplier->alamat, 80) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button type="button" onclick="openEditModal({{ $supplier->id }}, @json($supplier->nama), @json($supplier->no_telp), @json($supplier->alamat))" class="text-slate-400 hover:text-amber-500 transition-colors" aria-label="Edit Supplier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" onclick="openDeleteModal({{ $supplier->id }})" class="text-slate-400 hover:text-red-500 transition-colors" aria-label="Hapus Supplier">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button type="button" onclick="openDetailModal(@json($supplier->nama), @json($supplier->no_telp), @json($supplier->alamat))" class="text-slate-400 hover:text-blue-500 transition-colors" aria-label="Lihat Detail Supplier">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">Tidak ada supplier yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-slate-500">Halaman {{ $suppliers->currentPage() }} dari {{ $suppliers->lastPage() }}</p>
                    <div class="flex items-center gap-2">
                        {{ $suppliers->withQueryString()->links('vendor.pagination.simple-tailwind') }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="modalTambahSupplier" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                <div class="flex items-start justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white text-xl shadow-lg shadow-blue-200">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Supplier Baru</h3>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Tambahkan supplier baru ke inventaris</p>
                        </div>
                    </div>
                    <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition-colors" data-modal-hide="modalTambahSupplier">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form id="addSupplierForm" action="{{ route('admin.supplier.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Supplier</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan nama supplier" required>
                            @error('nama')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. HP</label>
                            <input type="text" name="no_telp" value="{{ old('no_telp') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan nomor telepon" required>
                            @error('no_telp')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all resize-none" placeholder="Masukkan alamat" required>{{ old('alamat') }}</textarea>
                        @error('alamat')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <button data-modal-hide="modalTambahSupplier" type="button" class="px-8 py-2.5 bg-slate-100 text-slate-500 rounded-xl font-bold hover:bg-slate-200 transition-all text-sm">
                            Batal
                        </button>
                        <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all text-sm uppercase">
                            Tambah Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modalEdit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="flex items-start justify-between p-6">
                    <div class="flex items-center gap-4">
                        <div>
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest">Update Registry</span>
                            <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">Edit Data Supplier</h2>
                        </div>
                    </div>
                    <button type="button" data-modal-hide="modalEdit" class="bg-slate-100 hover:bg-slate-200 text-slate-400 w-10 h-10 rounded-full transition-all flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="editSupplierForm" action="" method="POST" class="px-8 py-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editSupplierId" name="id" value="{{ old('id') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Supplier</label>
                            <input id="editNama" type="text" name="nama" value="{{ old('nama') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" placeholder="Masukkan nama supplier" required>
                            @error('nama')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. HP</label>
                            <input id="editPhone" type="text" name="no_telp" value="{{ old('no_telp') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" placeholder="Masukkan nomor telepon" required>
                            @error('no_telp')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alamat</label>
                        <textarea id="editAddress" name="alamat" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all resize-none text-slate-600 leading-relaxed" placeholder="Masukkan alamat" required>{{ old('alamat') }}</textarea>
                        @error('alamat')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
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

    <div id="modalDetailSupplier" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
                <div class="flex items-center justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-sky-100">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Rincian Supplier</h2>
                    </div>
                    <button type="button" data-modal-hide="modalDetailSupplier" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="space-y-2">
                            <label class="block text-[12px] font-bold text-slate-900 uppercase tracking-[0.15em]">Nama Supplier</label>
                            <div id="detail-name" class="w-full px-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-600 shadow-sm"></div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[12px] font-bold text-slate-900 uppercase tracking-[0.15em]">No. HP</label>
                            <div id="detail-phone" class="w-full px-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-600 shadow-sm"></div>
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-[12px] font-bold text-slate-900 uppercase tracking-[0.15em]">Alamat</label>
                            <div id="detail-address" class="w-full px-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-600 leading-relaxed shadow-sm"></div>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-6 border-t border-slate-50 flex justify-end">
                    <button data-modal-hide="modalDetailSupplier" type="button" class="px-10 py-3 bg-white border-2 border-slate-100 text-slate-800 rounded-2xl font-bold hover:bg-slate-50 hover:border-slate-200 transition-all text-xs uppercase tracking-widest shadow-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalDelete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-red-900/20 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden text-center border-4 border-red-50 mx-auto">
            <div class="p-10">
                <div class="relative w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-75"></div>
                    <i class="fas fa-trash-alt text-4xl text-red-600 relative"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-3">Hapus Data?</h3>
                <p class="text-slate-500 text-sm mb-8">Data akan dihapus secara permanen.</p>
                <form id="deleteSupplierForm" action="" method="POST" class="space-y-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">Ya, Hapus Sekarang</button>
                    <button type="button" data-modal-hide="modalDelete" class="w-full py-4 bg-white text-slate-400 rounded-2xl font-bold hover:text-slate-600 transition-all">Batal</button>
                </form>
            </div>
        </div>
    </div>


    @include('layout.partials.aos-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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

        function openEditModal(id, nama, no_telp, alamat) {
            const modal = document.getElementById('modalEdit');
            const form = document.getElementById('editSupplierForm');
            const inputId = document.getElementById('editSupplierId');

            document.getElementById('editNama').value = nama;
            document.getElementById('editPhone').value = no_telp;
            document.getElementById('editAddress').value = alamat;
            inputId.value = id;
            form.action = `/admin/supplier/${id}`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openDetailModal(nama, no_telp, alamat) {
            document.getElementById('detail-name').textContent = nama;
            document.getElementById('detail-phone').textContent = no_telp;
            document.getElementById('detail-address').textContent = alamat;

            const modal = document.getElementById('modalDetailSupplier');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openDeleteModal(id) {
            const form = document.getElementById('deleteSupplierForm');
            form.action = `/admin/supplier/${id}`;
            const modal = document.getElementById('modalDelete');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        @if(session('toast_success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('toast_success') }}"
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            @if($errors->any())
                @if(old('_method') == 'PUT' && old('id'))
                    openEditModal({{ old('id') }}, @json(old('nama')), @json(old('no_telp')), @json(old('alamat')));
                @else
                    const modal = document.getElementById('modalTambahSupplier');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                @endif
            @endif
        });
    </script>
</body>
</html>