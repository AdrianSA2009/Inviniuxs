<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Keluar - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-nav::-webkit-scrollbar { width: 0px; background: transparent; }
        .sidebar-nav { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-hover:hover { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); }
        tr.hover-row:hover { background-color: #f8fafc; transition: all 0.2s; }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 h-screen flex overflow-hidden">

    @include('layout.sidebar')
    <div class="flex-1 flex flex-col w-full md:ml-72 overflow-hidden transition-all duration-300">
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

        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6 bg-slate-50">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <span>Transaksi</span>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Barang Keluar</span>
                    </nav>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Riwayat Barang Keluar</h2>
                </div>
                <button data-modal-target="modalTambahTransaksi" data-modal-toggle="modalTambahTransaksi" class="flex items-center gap-2 px-6 py-3 bg-blue-600 rounded-xl text-white font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Barang</span>
                </button>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <div class="relative w-full group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" id="searchInput" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400 text-sm" placeholder="Cari nama barang...">
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">No</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Nama Barang</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Jumlah</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Tanggal Keluar</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Penerima</th>
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50" id="tableBody">
                            @forelse($barangKeluar as $item)
                            <tr class="hover-row group" data-id="{{ $item->id }}" data-nama="{{ $item->barang->nama ?? '' }}">
                                <td class="px-8 py-6 font-bold text-slate-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">{{ $item->barang->nama ?? '-' }}</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">{{ $item->jumlah }} UNIT</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">{{ \Carbon\Carbon::parse($item->tgl_keluar)->format('d M Y') }}</td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">{{ $item->karyawan->name ?? 'Admin' }}</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick="bukaDetail({id: {{ $item->id }}, barang: '{{ $item->barang->nama ?? '' }}', jumlah: {{ $item->jumlah }}, tgl: '{{ $item->tgl_keluar }}', kategori: '{{ $item->barang->kategori->nama ?? '' }}', penerima: '{{ $item->karyawan->name ?? 'Admin' }}'})" data-modal-target="modalDetail" data-modal-toggle="modalDetail" class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="bukaEdit({id: {{ $item->id }}, barang_id: {{ $item->barang_id }}, jumlah: {{ $item->jumlah }}, tgl: '{{ $item->tgl_keluar }}'})" data-modal-target="modalEdit" data-modal-toggle="modalEdit" class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="bukaDelete({{ $item->id }}, '{{ $item->barang->nama ?? '' }}')" data-modal-target="modalDelete" data-modal-toggle="modalDelete" class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-8 py-6 text-center text-slate-500">Belum ada data barang keluar</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambahTransaksi" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" data-modal-hide="modalTambahTransaksi"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                <div class="flex items-start justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white text-xl shadow-lg shadow-blue-200">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Tambah Barang Keluar</h3>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Tambahkan transaksi barang keluar ke sistem</p>
                        </div>
                    </div>
                    <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition-colors" data-modal-hide="modalTambahTransaksi">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('barang-keluar.store') }}" class="p-8">
                    @csrf
                    <div class="space-y-6 mb-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</label>
                            <select name="barang_id" id="barang_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                                <option value="" disabled selected>Pilih barang</option>
                                @foreach($barang as $b)
                                <option value="{{ $b->id }}">{{ $b->nama }} (Stok: {{ $b->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Keluar</label>
                                <input type="date" name="tgl_keluar" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                            </div>
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Unit</label>
                                <input type="number" name="jumlah" min="1" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan jumlah" required>
                            </div>
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

    <!-- Modal Edit -->
    <div id="modalEdit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center w-full h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="hideModal('modalEdit')"></div>
        
        <div class="relative p-4 w-full max-w-2xl max-h-full z-10 my-auto">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                
                <div class="flex items-start justify-between p-6 border-b border-slate-100">
                    <div>
                        <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest">Update Registry</span>
                        <h2 class="text-xl font-bold text-slate-800 mt-2 tracking-tight">Edit Barang Keluar</h2>
                    </div>
                    <button type="button" data-modal-hide="modalEdit" class="bg-slate-100 hover:bg-slate-200 text-slate-400 w-10 h-10 rounded-full transition-all flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="formEdit" method="POST" class="px-8 py-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6 mb-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</label>
                            <select name="barang_id" id="edit-barang_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all" required>
                                <option value="" disabled>Pilih barang</option>
                                @foreach($barang as $b)
                                <option value="{{ $b->id }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Keluar</label>
                                <input type="date" name="tgl_keluar" id="edit-tgl" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all" required>
                            </div>
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Unit</label>
                                <input type="number" name="jumlah" id="edit-jumlah" min="1" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all" required>
                            </div>
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

    <!-- Modal Detail -->
    <div id="modalDetail" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
                <div class="flex items-center justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-sky-100">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Rincian Barang Keluar</h2>
                    </div>
                    <button type="button" data-modal-hide="modalDetail" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <div class="px-8 py-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Nama Barang</label>
                            <p id="detail-barang" class="text-slate-800 font-semibold">-</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Kategori</label>
                                <p id="detail-kategori" class="text-slate-800 font-semibold">-</p>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Jumlah</label>
                                <p id="detail-jumlah" class="text-slate-800 font-semibold">-</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Tanggal Keluar</label>
                                <p id="detail-tgl" class="text-slate-800 font-semibold">-</p>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Penerima</label>
                                <p id="detail-penerima" class="text-slate-800 font-semibold">-</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-6 border-t border-slate-50 flex justify-end mt-6">
                        <button data-modal-hide="modalDetail" type="button" class="px-10 py-3 bg-white border-2 border-slate-100 text-slate-800 rounded-2xl font-bold hover:bg-slate-50 hover:border-slate-200 transition-all text-xs uppercase tracking-widest shadow-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div id="modalDelete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-red-900/20 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden text-center border-4 border-red-50 mx-auto">
            <div class="p-10">
                <div class="relative w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-75"></div>
                    <i class="fas fa-trash-alt text-4xl text-red-600 relative"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-3">Hapus Data?</h3>
                <p id="delete-barang-label" class="text-slate-800 font-semibold mb-2">-</p>
                <p class="text-slate-500 text-sm mb-8">Data akan dihapus secara permanen.</p>
                <div class="space-y-3">
                    <form id="formDelete" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">Ya, Hapus Sekarang</button>
                    </form>
                    <button data-modal-hide="modalDelete" class="w-full py-4 bg-white text-slate-400 rounded-2xl font-bold hover:text-slate-600 transition-all">Cancel Action</button>
                </div>
            </div>
        </div>
    </div>

    @if(session('toast_success'))
        <div id="toast-success" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-xl shadow-2xl dark:text-gray-400 dark:bg-gray-800 transition-opacity duration-500 z-50 border border-slate-100" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <i class="fas fa-check"></i>
            </div>
            <div class="ms-3 text-sm font-semibold text-slate-700">{{ session('toast_success') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8" onclick="document.getElementById('toast-success').remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div id="toast-error" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-xl shadow-2xl dark:text-gray-400 dark:bg-gray-800 transition-opacity duration-500 z-50 border border-red-100" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="ms-3 text-sm font-semibold text-slate-700">{{ session('error') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8" onclick="document.getElementById('toast-error').remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init({ duration: 800, once: true, easing: 'ease-in-out' });

        function showModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.remove('hidden');
            el.classList.add('flex');
        }
        
        function hideModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex');
        }

        function bukaDetail(data) {
            document.getElementById('detail-barang').textContent = data.barang || '-';
            document.getElementById('detail-kategori').textContent = data.kategori || '-';
            document.getElementById('detail-jumlah').textContent = data.jumlah + ' Unit' || '-';
            document.getElementById('detail-tgl').textContent = new Date(data.tgl).toLocaleDateString('id-ID') || '-';
            document.getElementById('detail-penerima').textContent = data.penerima || '-';
            showModal('modalDetail');
        }

        function bukaEdit(data) {
            document.getElementById('edit-barang_id').value = data.barang_id || '';
            document.getElementById('edit-tgl').value = data.tgl || '';
            document.getElementById('edit-jumlah').value = data.jumlah || '';
            
            const form = document.getElementById('formEdit');
            form.action = '/admin/barangkeluar/' + data.id;
            
            showModal('modalEdit');
        }

        function bukaDelete(id, namaBarang) {
            document.getElementById('delete-barang-label').textContent = namaBarang;
            const form = document.getElementById('formDelete');
            form.action = '/admin/barangkeluar/' + id;
            showModal('modalDelete');
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');
            
            rows.forEach(row => {
                const namaBarang = row.getAttribute('data-nama').toLowerCase();
                if (namaBarang.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500
        });

        @if(session('toast_success'))
            Toast.fire({ icon: 'success', title: "{{ session('toast_success') }}" });
        @endif

        @if(session('error'))
            Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
        @endif
    </script>
</body>
</html>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Nama Barang</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Jumlah</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Penerima</th>
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 font-bold text-slate-800 uppercase tracking-tight">BRGN-020</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">LG GN-B202SQIB 2 Pintu 202L</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">6 UNIT</td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">Toko Sinar Digital</span>
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
                                <td class="px-8 py-6 font-bold text-slate-800 uppercase tracking-tight">BRGU-023</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">Samsung Kulkas 2 Pintu RT47 465L</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">8 UNIT</td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">Swalayan Maju Jaya</span>
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
                        <div class="w-12 h-12 bg-blu
                        e-600 rounded-lg flex items-center justify-center text-white text-xl shadow-lg shadow-blue-200">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Tambah Barang Keluar</h3>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Tambahkan transaksi barang keluar ke sistem</p>
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
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penerima</label>
                                <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Masukkan penerima" required>
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
                            <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">Edit Barang Keluar</h2>
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
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penerima</label>
                            <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all">
                                <option value="PT. Panasonic Gobel Indonesia" selected>Toko Sinar Digital</option>
                                <option value="PT. Samsung Electronics Indonesia">Swalayan Maju Jaya</option>
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
                                            <input type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" value="Panasonic NR-BB201 Q-S 2 Pintu" required>
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
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Rincian Barang Keluar</h2>
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
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penerima</label>
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