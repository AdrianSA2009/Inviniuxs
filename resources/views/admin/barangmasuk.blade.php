<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('layout.partials.aos-head')
    
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
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4" data-aos="fade-down">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <span>Transaksi</span>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Barang Masuk</span>
                    </nav>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Transaksi Barang Masuk</h2>
                </div>
                <button data-modal-target="modalTambahTransaksi" data-modal-toggle="modalTambahTransaksi" class="flex items-center gap-2 px-6 py-3 bg-blue-600 rounded-xl text-white font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Barang</span>
                </button>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100" data-aos="fade-up" data-aos-delay="100">
                <div class="relative w-full group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input id="searchInput" type="text" value="{{ request('search') }}" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400 text-sm" placeholder="Cari nama transaksi / supplier / PIC...">
                </div>
            </div>
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Kode Transaksi</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400">Jumlah</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Supplier</th>
                                <th class="px-6 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">PIC</th>
                                <th class="px-8 py-5 text-[11px] uppercase tracking-widest font-bold text-slate-400 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ajax-list-tbody" class="divide-y divide-slate-50">
                            @forelse($barangMasuk as $item)
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 font-bold text-slate-800 uppercase tracking-tight">{{ $item->kode_transaksi }}</td>
                                <td class="px-6 py-6 text-sm text-slate-500 font-medium">{{ $item->jumlah }} UNIT</td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                                        {{ $item->supplier->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-semibold">
                                        {{ $item->karyawan->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button"
                                            onclick="bukaDetail({
                                                kode: '{{ $item->kode_transaksi }}',
                                                tgl: '{{ $item->tgl_masuk }}',
                                                barang: '{{ $item->barang->nama ?? '-' }}',
                                                kategori: '{{ $item->barang->kategori->nama ?? '-' }}',
                                                supplier: '{{ $item->supplier->nama ?? '-' }}',
                                                pic: '{{ $item->karyawan->nama ?? '-' }}',
                                                jumlah: {{ $item->jumlah }},
                                                units: {{ json_encode($item->unitBarang->map(fn($u) => ['sn' => $u->serial_number, 'nama' => $item->barang->nama ?? '-'])) }}
                                            })"
                                            class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button"
                                            onclick="bukaEdit({
                                                id: {{ $item->id }},
                                                tgl: '{{ $item->tgl_masuk }}',
                                                kode: '{{ $item->kode_transaksi }}',
                                                kategori_id: {{ $item->barang->kategori_id ?? 'null' }},
                                                nama: '{{ addslashes($item->barang->nama ?? '') }}',
                                                supplier_id: {{ $item->supplier_id ?? 'null' }},
                                                units: {{ json_encode($item->unitBarang->map(fn($u) => ['id' => $u->id, 'sn' => $u->serial_number])) }}
                                            })"
                                            class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button"
                                            onclick="bukaDelete({{ $item->id }}, '{{ $item->kode_transaksi }}')"
                                            class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center text-slate-400 text-sm">Belum ada data transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div id="ajax-list-footer" class="p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-slate-500">Menampilkan {{ $barangMasuk->count() }} dari {{ $barangMasuk->total() }} transaksi</p>
                    @if ($barangMasuk->hasPages())
                        <div class="flex items-center gap-2">
                            <a href="{{ $barangMasuk->previousPageUrl() ?: '#' }}" class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm {{ $barangMasuk->onFirstPage() ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                                Previous
                            </a>

                            @foreach ($barangMasuk->getUrlRange(1, $barangMasuk->lastPage()) as $page => $url)
                                @if ($page == $barangMasuk->currentPage())
                                    <span class="w-8 h-8 bg-blue-600 text-white rounded-lg text-sm font-bold flex items-center justify-center">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="w-8 h-8 hover:bg-slate-100 text-slate-600 rounded-lg text-sm transition-all flex items-center justify-center">{{ $page }}</a>
                                @endif
                            @endforeach

                            <a href="{{ $barangMasuk->nextPageUrl() ?: '#' }}" class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition-all text-sm {{ $barangMasuk->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed pointer-events-none' }}">
                                Next
                            </a>
                        </div>
                    @endif
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

                <form action="{{ route('barang-masuk.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="space-y-6 mb-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Masuk</label>
                            <input type="date" name="tgl_masuk" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori Barang</label>
                                <select name="kategori_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                                    <option value="" disabled selected>Pilih kategori barang</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Supplier</label>
                                <select name="supplier_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all" required>
                                    <option value="" disabled selected>Pilih Supplier</option>
                                    @foreach($suppliers as $sup)
                                        <option value="{{ $sup->id }}">{{ $sup->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="hidden-fields-container"></div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Daftar Unit</label>
                            <button type="button" id="btnOpenInputUnit"
                                class="px-4 py-1.5 bg-blue-600 text-white text-[10px] font-black rounded-lg shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all uppercase tracking-wider">
                                Input
                            </button>
                        </div>

                        <div class="border border-slate-100 rounded-[2rem] overflow-hidden shadow-sm bg-white">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/80 border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left w-16">No</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Serial Number</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Nama Barang</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="overflow-y-auto" id="unitTambahScroll" style="max-height: 80px;">
                                <table class="w-full text-left">
                                    <tbody id="unitTambahBody" class="divide-y divide-slate-50">
                                        <tr id="emptyUnitRow">
                                            <td colspan="3" class="px-6 py-6 text-center text-xs text-slate-400">
                                                Belum ada unit. Klik <span class="font-bold text-blue-500">Input</span> untuk menambahkan.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 mt-6">
                        <button data-modal-hide="modalTambahTransaksi" type="button" class="px-8 py-2.5 bg-slate-100 text-slate-500 rounded-xl font-bold hover:bg-slate-200 transition-all text-sm">
                            Batal
                        </button>
                        <button type="submit" id="btnSubmitTambah" disabled
                            class="px-8 py-2.5 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all text-sm uppercase disabled:opacity-40 disabled:cursor-not-allowed">
                            Tambah Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah -->

    <!-- Modal Input Unit -->
    <div id="modalInputUnit" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[60] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40"></div>
        <div class="relative p-4 w-full max-w-md max-h-full z-50">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                <div class="flex items-start justify-between p-5 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-barcode text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Input Detail Unit</h3>
                    </div>
                    <button type="button" id="btnCloseInputUnit"
                        class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Serial Number</label>
                        <input type="text" id="input-sn"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all uppercase placeholder:text-slate-400"
                            placeholder="Masukkan serial number">
                        <p id="sn-error" class="mt-1 text-xs text-red-500 hidden">Serial number tidak boleh kosong.</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</label>
                        <input type="text" id="input-nama"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none text-sm font-semibold transition-all placeholder:text-slate-400"
                            placeholder="Masukkan nama barang">
                        <p id="nama-error" class="mt-1 text-xs text-red-500 hidden">Nama barang tidak boleh kosong.</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 p-5 border-t border-slate-100">
                    <button id="btnCancelInputUnit" type="button"
                        class="px-5 py-2 bg-slate-100 text-slate-500 rounded-xl font-bold hover:bg-slate-200 transition-all text-sm">
                        Batal
                    </button>
                    <button id="btnSaveUnit" type="button" onclick="simpanDataUnit()"
                        class="px-5 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all text-sm">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Input Unit -->

    <!-- Modal Detail -->
    <div id="modalDetail" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-sky-500 rounded-lg flex items-center justify-center text-white shadow shadow-sky-100">
                            <i class="fas fa-file-alt text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Detail Transaksi</p>
                            <h2 id="detail-kode" class="text-base font-black text-slate-800 tracking-tight leading-tight">-</h2>
                        </div>
                    </div>
                    <button type="button" onclick="hideModal('modalDetail')" class="text-slate-400 hover:text-slate-600 transition-colors w-7 h-7 flex items-center justify-center rounded-lg hover:bg-slate-100">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
 
                <div class="px-5 py-4">
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div>
                            <label class="block mb-1 text-[9px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Masuk</label>
                            <input type="date" id="detail-tgl" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-xs font-semibold text-slate-700" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-[9px] font-bold text-slate-400 uppercase tracking-widest">Kategori</label>
                            <input type="text" id="detail-kategori" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-xs font-semibold text-slate-700" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-[9px] font-bold text-slate-400 uppercase tracking-widest">Supplier</label>
                            <input type="text" id="detail-supplier" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-xs font-semibold text-slate-700" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-[9px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Unit</label>
                            <input type="text" id="detail-jumlah" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-xs font-semibold text-slate-700" readonly>
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-1 text-[9px] font-bold text-slate-400 uppercase tracking-widest">PIC</label>
                            <input type="text" id="detail-pic" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-xs font-semibold text-slate-700" readonly>
                        </div>
                    </div>
 
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] px-1">Daftar Unit</label>
                        <div class="border border-slate-100 rounded-xl overflow-hidden shadow-sm bg-white">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/80 border-b border-slate-100">
                                    <tr>
                                        <th class="px-4 py-2.5 text-[8px] font-black text-slate-400 uppercase tracking-widest text-left w-10">No</th>
                                        <th class="px-4 py-2.5 text-[8px] font-black text-slate-400 uppercase tracking-widest text-left">Serial Number</th>
                                        <th class="px-4 py-2.5 text-[8px] font-black text-slate-400 uppercase tracking-widest text-left">Nama Barang</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="overflow-y-auto" style="max-height: 100px;">
                                <table class="w-full text-left">
                                    <tbody id="detail-unit-body" class="divide-y divide-slate-50"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
 
                    <div class="pt-4 flex justify-end">
                        <button type="button" onclick="hideModal('modalDetail')" class="px-6 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all text-xs uppercase tracking-widest shadow-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Detail -->

    <!-- Modal Edit -->
    <div id="modalEdit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center w-full h-full transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="hideModal('modalEdit')"></div>
        
        <div class="relative p-4 w-full max-w-2xl max-h-full z-10 my-auto">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                
                <div class="flex items-start justify-between p-6 border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-edit text-amber-600 text-lg"></i>
                        </div>
                        <div>
                            <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest">Update Registry</span>
                            <h2 id="edit-kode-label" class="text-xl font-extrabold text-slate-800 mt-1 tracking-tight">Edit Barang Masuk</h2>
                        </div>
                    </div>
                    <button type="button" onclick="hideModal('modalEdit')" class="bg-slate-100 hover:bg-slate-200 text-slate-400 w-10 h-10 rounded-full transition-all flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
    
                <form id="formEdit" method="POST" class="px-8 py-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6 mb-6">
                        <div>
                            <label class="block mb-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Masuk</label>
                            <input type="date" name="tgl_masuk" id="edit-tgl"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" required>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori Barang</label>
                                <select name="kategori_id" id="edit-kategori"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" required>
                                    <option value="" disabled>Pilih kategori barang</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Supplier</label>
                                <select name="supplier_id" id="edit-supplier"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none text-sm font-semibold transition-all text-slate-700" required>
                                    <option value="" disabled>Pilih supplier</option>
                                    @foreach($suppliers as $sup)
                                        <option value="{{ $sup->id }}">{{ $sup->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
    
                    <div id="hidden-edit-fields-container"></div>
    
                    <div class="space-y-4 mt-6">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Daftar Unit</label>
                            <button type="button" id="btnOpenEditInputUnit"
                                class="px-4 py-1.5 bg-blue-600 text-white text-[10px] font-black rounded-lg shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all uppercase tracking-wider">
                                Input
                            </button>
                        </div>
    
                        <div class="border border-slate-100 rounded-[2rem] overflow-hidden shadow-sm bg-white">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/80 border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left w-16">No</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Serial Number</th>
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="overflow-y-auto" style="max-height: 80px;">
                                <table class="w-full text-left">
                                    <tbody id="unitEditBody" class="divide-y divide-slate-50">
                                        <tr id="emptyEditUnitRow">
                                            <td colspan="3" class="px-6 py-6 text-left text-xs text-slate-400">
                                                Belum ada unit. Klik <span class="font-bold text-blue-500">Input</span> untuk menambahkan.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 mt-6">
                        <button type="button" onclick="hideModal('modalEdit')" class="px-8 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all text-xs uppercase tracking-widest">
                            Batal
                        </button>
                        <button type="submit" class="px-8 py-2.5 bg-amber-500 text-white rounded-xl font-bold hover:bg-amber-600 transition-all text-xs uppercase tracking-widest shadow-lg shadow-amber-100">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
                </div>
        </div>
    </div>
    <!-- End Modal Edit -->

    <!-- Modal Delete -->
    <div id="modalDelete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-red-900/20 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden text-center border-4 border-red-50 mx-auto">
            <div class="p-10">
                <div class="relative w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-75"></div>
                    <i class="fas fa-trash-alt text-4xl text-red-600 relative"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2">Hapus Data?</h3>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Kode Transaksi</p>
                <p id="delete-kode-label" class="text-slate-700 font-black text-base mb-6">-</p>
                <p class="text-slate-500 text-sm mb-8">Data transaksi beserta seluruh unit akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
                <form id="formDelete" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="space-y-3">
                        <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">
                            Ya, Hapus Sekarang
                        </button>
                        <button type="button" onclick="hideModal('modalDelete')" class="w-full py-4 bg-white text-slate-400 rounded-2xl font-bold hover:text-slate-600 transition-all">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layout.partials.aos-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ── Helpers: show/hide modal ───────────────────────────────────────
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

        // ── MODAL DETAIL ───────────────────────────────────────────────────
        function bukaDetail(data) {
            document.getElementById('detail-kode').textContent     = data.kode;
            document.getElementById('detail-tgl').value           = data.tgl;
            document.getElementById('detail-kategori').value      = data.kategori;
            document.getElementById('detail-supplier').value      = data.supplier;
            document.getElementById('detail-jumlah').value        = data.jumlah + ' Unit';
            document.getElementById('detail-pic').value           = data.pic || '-';

            const tbody = document.getElementById('detail-unit-body');
            tbody.innerHTML = '';
            if (!data.units || data.units.length === 0) {
                tbody.innerHTML = '<tr><td colspan="2" class="px-5 py-5 text-left text-xs text-slate-400">Tidak ada unit.</td></tr>';
            } else {
                data.units.forEach(function(unit, i) {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-slate-50/50 transition-colors';
                    tr.innerHTML =
                        '<td class="px-5 py-3.5 text-left text-xs font-bold text-slate-800">' + (i + 1) + '</td>' +
                        '<td class="px-5 py-3.5">' +
                            '<span class="text-xs font-mono font-bold text-blue-600 px-2 py-1 bg-blue-50 rounded-lg uppercase tracking-tight">' + unit.sn + '</span>' +
                        '</td>' +
                        '<td class="px-5 py-3.5 text-sm text-slate-700">' + (unit.nama || data.barang || '-') + '</td>';
                    tbody.appendChild(tr);
                });
            }

            showModal('modalDetail');
        }

        // ── MODAL EDIT ─────────────────────────────────────────────────────
        function bukaEdit(data) {
            document.getElementById('edit-kode-label').textContent = data.kode;
            document.getElementById('edit-tgl').value = data.tgl;
            document.getElementById('edit-kategori').value = data.kategori_id || '';
            document.getElementById('edit-supplier').value = data.supplier_id || '';
            currentEditNamaBarang = data.nama || '';

            editUnitList = Array.isArray(data.units) ? data.units.map(function(unit) {
                return {
                    id: unit.id || null,
                    sn: unit.sn || ''
                };
            }) : [];

            renderUnitTable('edit');
            rebuildHiddenFields('edit');

            const form = document.getElementById('formEdit');
            form.action = '/admin/barangmasuk/' + data.id;

            showModal('modalEdit');
        }

        // ── MODAL DELETE ───────────────────────────────────────────────────
        function bukaDelete(id, kode) {
            document.getElementById('delete-kode-label').textContent = kode;

            const form = document.getElementById('formDelete');
            form.action = '/admin/barangmasuk/' + id;

            showModal('modalDelete');
        }

        // ── MODAL TAMBAH / EDIT — buka modalInputUnit ────────────────────────────
        const addUnitList = [];
        let editUnitList = [];
        let activeUnitMode = 'add';
        let activeUnitIndex = null;
        let currentEditNamaBarang = '';
        let isSavingUnit = false;

        function normalizeSerial(value) {
            return String(value).trim().toUpperCase();
        }

        function normalizeNama(value) {
            return String(value).trim();
        }

        function updateSubmitButtonState() {
            const submitBtn = document.getElementById('btnSubmitTambah');
            if (!submitBtn) return;
            submitBtn.disabled = addUnitList.length === 0;
        }

        function getUnitList(mode) {
            return mode === 'edit' ? editUnitList : addUnitList;
        }

        function renderUnitTable(mode) {
            const tbody = document.getElementById(mode === 'edit' ? 'unitEditBody' : 'unitTambahBody');
            const units = getUnitList(mode);
            const emptyRowId = mode === 'edit' ? 'emptyEditUnitRow' : 'emptyUnitRow';

            tbody.innerHTML = '';
            if (units.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.id = emptyRowId;
                emptyRow.innerHTML = '<td colspan="' + (mode === 'edit' ? '3' : '3') + '" class="px-6 py-6 text-left text-xs text-slate-400">' +
                    (mode === 'edit' ? 'Belum ada unit. Klik <span class="font-bold text-blue-500">Input</span> untuk menambahkan.' : 'Belum ada unit. Tambahkan unit terlebih dahulu.') +
                    '</td>';
                tbody.appendChild(emptyRow);
                return;
            }

            units.forEach(function(unit, index) {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-slate-50/50 transition-colors';
                if (mode === 'edit') {
                    tr.innerHTML =
                        '<td class="px-6 py-4 text-left text-xs font-bold text-slate-800">' + (index + 1) + '</td>' +
                        '<td class="px-6 py-4 text-left"><span class="text-xs font-mono font-bold text-blue-600 px-2 py-1 bg-blue-50 rounded-lg uppercase tracking-tight">' + unit.sn + '</span></td>' +
                        '<td class="px-6 py-4 text-left text-xs font-medium text-slate-700 flex items-center gap-2">' +
                            '<button type="button" onclick="editUnitRow(' + index + ')" class="px-3 py-1 bg-amber-50 text-amber-700 rounded-lg border border-amber-100 hover:bg-amber-100 transition">Edit</button>' +
                            '<button type="button" onclick="deleteEditUnit(' + index + ')" class="px-3 py-1 bg-red-50 text-red-700 rounded-lg border border-red-100 hover:bg-red-100 transition">Hapus</button>' +
                        '</td>';
                } else {
                    tr.innerHTML =
                        '<td class="px-6 py-4 text-left text-xs font-bold text-slate-800">' + (index + 1) + '</td>' +
                        '<td class="px-6 py-4 text-left"><span class="text-xs font-mono font-bold text-blue-600 px-2 py-1 bg-blue-50 rounded-lg uppercase tracking-tight">' + unit.sn + '</span></td>' +
                        '<td class="px-6 py-4 text-left text-xs font-medium text-slate-700">' + unit.nama + '</td>';
                }
                tbody.appendChild(tr);
            });
        }

        function rebuildHiddenFields(mode) {
            const container = document.getElementById(mode === 'edit' ? 'hidden-edit-fields-container' : 'hidden-fields-container');
            container.innerHTML = '';
            const units = getUnitList(mode);

            if (mode === 'edit') {
                const hiddenNama = document.createElement('input');
                hiddenNama.type = 'hidden';
                hiddenNama.name = 'nama_barang';
                hiddenNama.value = currentEditNamaBarang;
                container.appendChild(hiddenNama);

                units.forEach(function(unit) {
                    const hiddenId = document.createElement('input');
                    hiddenId.type = 'hidden';
                    hiddenId.name = 'unit_id[]';
                    hiddenId.value = unit.id || '';
                    container.appendChild(hiddenId);

                    const hiddenSn = document.createElement('input');
                    hiddenSn.type = 'hidden';
                    hiddenSn.name = 'serial_number[]';
                    hiddenSn.value = unit.sn;
                    container.appendChild(hiddenSn);
                });
                return;
            }

            if (units.length > 0) {
                const hiddenNama = document.createElement('input');
                hiddenNama.type = 'hidden';
                hiddenNama.name = 'nama_barang';
                hiddenNama.value = units[0].nama;
                container.appendChild(hiddenNama);
            }

            units.forEach(function(unit) {
                const hiddenSn = document.createElement('input');
                hiddenSn.type = 'hidden';
                hiddenSn.name = 'serial_number[]';
                hiddenSn.value = unit.sn;
                container.appendChild(hiddenSn);
            });
        }

        function openInputUnit(mode, index = null) {
            activeUnitMode = mode;
            activeUnitIndex = index;
            const snInput = document.getElementById('input-sn');
            const namaInput = document.getElementById('input-nama');
            const snErr = document.getElementById('sn-error');
            const namaErr = document.getElementById('nama-error');

            snErr.classList.add('hidden');
            namaErr.classList.add('hidden');

            if (mode === 'edit' && index !== null && editUnitList[index]) {
                snInput.value = editUnitList[index].sn;
                namaInput.value = currentEditNamaBarang;
            } else {
                snInput.value = '';
                namaInput.value = mode === 'edit' ? currentEditNamaBarang : '';
            }

            showModal('modalInputUnit');
        }

        async function checkSerialExists(serial, exceptId = null) {
            if (!serial) {
                return false;
            }

            const endpoint = '{{ route('barang-masuk.check-serial') }}';
            let url = `${endpoint}?serial_number=${encodeURIComponent(serial)}`;
            if (exceptId) {
                url += `&except_id=${encodeURIComponent(exceptId)}`;
            }

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                return false;
            }

            const data = await response.json();
            return data.exists === true;
        }

        document.getElementById('btnOpenInputUnit').addEventListener('click', function () {
            openInputUnit('add');
        });

        document.getElementById('btnOpenEditInputUnit').addEventListener('click', function () {
            openInputUnit('edit');
        });

        document.getElementById('btnCloseInputUnit').addEventListener('click', function () {
            hideModal('modalInputUnit');
        });
        document.getElementById('btnCancelInputUnit').addEventListener('click', function () {
            hideModal('modalInputUnit');
        });

        function editUnitRow(index) {
            openInputUnit('edit', index);
        }

        function deleteEditUnit(index) {
            if (index === null || index === undefined) {
                return;
            }
            editUnitList.splice(index, 1);
            renderUnitTable('edit');
            rebuildHiddenFields('edit');
        }

        async function simpanDataUnit() {
            if (isSavingUnit) {
                return;
            }

            const btnSave = document.getElementById('btnSaveUnit');
            const snInput = document.getElementById('input-sn');
            const namaInput = document.getElementById('input-nama');
            const snErr = document.getElementById('sn-error');
            const namaErr = document.getElementById('nama-error');
            let sn = '';
            let nama = '';

            isSavingUnit = true;
            if (btnSave) {
                btnSave.disabled = true;
                btnSave.classList.add('opacity-50', 'cursor-not-allowed');
            }

            try {
                sn = normalizeSerial(snInput.value);
                nama = normalizeNama(namaInput.value);

                snErr.classList.add('hidden');
                namaErr.classList.add('hidden');

                let valid = true;
                if (!sn) {
                    snErr.textContent = 'Serial number tidak boleh kosong.';
                    snErr.classList.remove('hidden');
                    valid = false;
                }
                if (!nama) {
                    namaErr.classList.remove('hidden');
                    valid = false;
                }
                if (!valid) {
                    return;
                }

                const units = getUnitList(activeUnitMode);
                const localDuplicate = units.some((unit, index) => {
                    if (activeUnitMode === 'edit' && index === activeUnitIndex) {
                        return false;
                    }
                    return unit.sn === sn;
                });

                if (localDuplicate) {
                    snErr.textContent = 'Serial number "' + sn + '" sudah terdata dalam daftar.';
                    snErr.classList.remove('hidden');
                    return;
                }

                const exceptId = activeUnitMode === 'edit' && activeUnitIndex !== null && editUnitList[activeUnitIndex] ? editUnitList[activeUnitIndex].id : null;
                const existsOnDb = await checkSerialExists(sn, exceptId);
                if (existsOnDb) {
                    snErr.textContent = 'Serial number "' + sn + '" sudah terdata di transaksi lain.';
                    snErr.classList.remove('hidden');
                    return;
                }

                if (activeUnitMode === 'edit' && activeUnitIndex !== null && editUnitList[activeUnitIndex]) {
                    editUnitList[activeUnitIndex].sn = sn;
                } else if (activeUnitMode === 'edit') {
                    editUnitList.push({ id: null, sn, nama });
                } else {
                    addUnitList.push({ sn, nama });
                }

                const mode = activeUnitMode;
                renderUnitTable(mode);
                rebuildHiddenFields(mode);

                snInput.value = '';
                namaInput.value = mode === 'edit' ? currentEditNamaBarang : '';
                hideModal('modalInputUnit');
                if (mode === 'add') {
                    updateSubmitButtonState();
                }
            } finally {
                isSavingUnit = false;
                if (btnSave) {
                    btnSave.disabled = false;
                    btnSave.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        }

        // ── Toast notifikasi ───────────────────────────────────────────────
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
            Toast.fire({ icon: 'success', title: "{{ session('toast_success') }}" });
        @endif

        @if(session('error'))
            Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
        @endif

    </script>
    @include('layout.partials.ajax-list-search-init', ['indexUrl' => route('barang-masuk.index')])
</body>
</html>