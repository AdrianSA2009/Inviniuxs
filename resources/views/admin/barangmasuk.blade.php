<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            
            @if($errors->has('unique_error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm flex items-center gap-3" role="alert">
                    <i class="fas fa-exclamation-circle text-lg"></i>
                    <div>
                        <span class="font-bold">Gagal Menyimpan Data:</span>
                        <p class="text-sm">{{ $errors->first('unique_error') }}</p>
                    </div>
                </div>
            @endif

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
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <div class="relative w-full group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400 text-sm" placeholder="Cari nama barang...">
                </div>
            </div>
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">ID Transaksi</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Nama Barang</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Jumlah</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Supplier</th>
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($barangMasuk as $item)
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 font-bold text-slate-800 uppercase tracking-tight">TRX-IN-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">{{ $item->barang->nama_barang ?? 'N/A' }}</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">{{ $item->jumlah }} UNIT</td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                                        {{ $item->supplier->nama_supplier ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button data-modal-target="modalDetail{{ $item->id }}" data-modal-toggle="modalDetail{{ $item->id }}" class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button data-modal-target="modalEdit{{ $item->id }}" data-modal-toggle="modalEdit{{ $item->id }}" class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button data-modal-target="modalDelete{{ $item->id }}" data-modal-toggle="modalDelete{{ $item->id }}" class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-6 text-center text-slate-400 text-sm">Belum ada riwayat transaksi barang masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            </main>
        </div>

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
                            <h3 class="text-xl font-bold text-slate-800">Tambah Barang Masuk</h3>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Tambahkan transaksi barang masuk ke sistem</p>
                        </div>
                    </div>
                    <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition-colors" data-modal-hide="modalTambahTransaksi">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <form action="{{ route('admin.barangmasuk.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="space-y-6 mb-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pilih Barang</label>
                            <select name="barang_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                                <option value="" disabled selected>-- Pilih unit barang dari inventaris --</option>
                                @foreach($barangs as $brg)
                                    <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">SUPPLIER</label>
                                <select name="supplier_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                                    <option value="" disabled selected>Pilih Supplier</option>
                                    @foreach($suppliers as $spl)
                                        <option value="{{ $spl->id }}">{{ $spl->nama_supplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">JUMLAH BARANG</label>
                                <input type="number" name="jumlah" min="1" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" placeholder="Contoh: 10" required>
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
    @foreach($barangMasuk as $item)
    <div id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" data-modal-hide="modalEdit{{ $item->id }}"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="flex items-start justify-between p-6">
                    <div class="flex items-center gap-4">
                        <div>
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest">Update Registry</span>
                            <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">Edit Barang Masuk</h2>
                        </div>
                    </div>
                    <button type="button" data-modal-hide="modalEdit{{ $item->id }}" class="bg-slate-100 hover:bg-slate-200 text-slate-400 w-10 h-10 rounded-full transition-all flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form action="{{ route('admin.barangmasuk.update', $item->id) }}" method="POST" class="px-8 py-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</label>
                            <select name="barang_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" required>
                                @foreach($barangs as $brg)
                                    <option value="{{ $brg->id }}" {{ $item->barang_id == $brg->id ? 'selected' : '' }}>{{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Supplier</label>
                            <select name="supplier_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                                @foreach($suppliers as $spl)
                                    <option value="{{ $spl->id }}" {{ $item->supplier_id == $spl->id ? 'selected' : '' }}>{{ $spl->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Unit</label>
                            <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" required>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <button data-modal-hide="modalEdit{{ $item->id }}" type="button" class="px-8 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all text-xs uppercase tracking-widest">
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
    <div id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" data-modal-hide="modalDetail{{ $item->id }}"></div>    
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
                <div class="flex items-center justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-sky-100">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Rincian Barang Masuk</h2>
                    </div>
                    <button type="button" data-modal-hide="modalDetail{{ $item->id }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <div class="px-8 py-6 space-y-4 text-sm">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">ID Transaksi</span>
                        <p class="font-bold text-slate-800 text-base">TRX-IN-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</span>
                        <p class="font-semibold text-slate-700">{{ $item->barang->nama_barang ?? 'N/A' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Supplier</span>
                            <p class="font-semibold text-slate-700">{{ $item->supplier->nama_supplier ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Masuk</span>
                            <p class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->tgl_masuk)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Kuantitas</span>
                        <p class="text-xl font-black text-blue-600">{{ $item->jumlah }} UNIT</p>
                    </div>
                </div>

                <div class="px-8 py-6 border-t border-slate-50 flex justify-end">
                    <button data-modal-hide="modalDetail{{ $item->id }}" type="button" class="px-10 py-3 bg-white border-2 border-slate-100 text-slate-800 rounded-2xl font-bold hover:bg-slate-50 hover:border-slate-200 transition-all text-xs uppercase tracking-widest shadow-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="modalDelete{{ $item->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-red-900/20 backdrop-blur-sm transition-opacity" data-modal-hide="modalDelete{{ $item->id }}"></div>
        <div class="relative bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden text-center border-4 border-red-50 mx-auto">
            <div class="p-10">
                <div class="relative w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-75"></div>
                    <i class="fas fa-trash-alt text-4xl text-red-600 relative"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-3">Hapus Data?</h3>
                <p class="text-slate-500 text-sm mb-8">Data transaksi barang masuk ini akan dihapus secara permanen dari riwayat.</p>
                <div class="space-y-3">
                    <form action="{{ route('admin.barangmasuk.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">Ya, Hapus Sekarang</button>
                    </form>
                    <button data-modal-hide="modalDelete{{ $item->id }}" class="w-full py-4 bg-white text-slate-400 rounded-2xl font-bold hover:text-slate-600 transition-all">Cancel Action</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if(session('toast_success'))
        <div id="toast-success" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-xl shadow-2xl dark:text-gray-400 dark:bg-gray-800 transition-opacity duration-500 z-50 border border-slate-100" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <i class="fas fa-check text-sm"></i>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-semibold text-slate-700">{{ session('toast_success') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8" onclick="document.getElementById('toast-success').remove()">
                <span class="sr-only">Close</span>
                <i class="fas fa-times"></i>
            </button>
        </div>

        <script>
            setTimeout(function() {
                let toast = document.getElementById('toast-success');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 3500);
        </script>
    @endif

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

        if(openSidebarBtn) openSidebarBtn.addEventListener('click', toggleSidebar);
        if(closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
        if(overlay) overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>