@php
    $user = auth()->user();
    $name = $user->nama ?? 'User';
    $words = explode(' ', trim($name));
    $initials = '';
    foreach ($words as $w) {
        if (!empty($w)) $initials .= mb_strtoupper(mb_substr($w, 0, 1));
        if (mb_strlen($initials) >= 2) break;
    }
    if (mb_strlen($initials) === 1) $initials .= mb_strtoupper(mb_substr($words[0] ?? '', 1, 1));
    $role = $user->role ?? '';
    $roleLabel = $role === 'admin_gudang' ? 'Admin Gudang' : ucfirst($role);
@endphp

<div class="relative" id="profileDropdownWrapper">
    <button type="button" id="profileDropdownBtn" class="flex items-center gap-3 hover:bg-slate-50 rounded-xl px-2 py-1.5 transition-all">
        <div class="hidden sm:block text-right">
            <p class="text-sm font-bold text-slate-900 leading-tight">{{ $name }}</p>
            <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">{{ $roleLabel }}</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200 text-sm">
            {{ $initials }}
        </div>
    </button>

    <div id="profileDropdown" class="hidden absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50">
        <div class="px-4 py-3 border-b border-slate-100">
            <p class="text-sm font-bold text-slate-800 truncate">{{ $name }}</p>
            <p class="text-xs text-slate-400 truncate">{{ $user->email ?? '-' }}</p>
        </div>
        <div class="py-1">
            <a href="{{ route('settings') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i class="fas fa-cog text-slate-400 w-4 text-center"></i>
                <span>Pengaturan</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="border-t border-slate-100">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                    <i class="fas fa-sign-out-alt w-4 text-center"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        const btn = document.getElementById('profileDropdownBtn');
        const dropdown = document.getElementById('profileDropdown');
        if (!btn || !dropdown) return;

        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    })();
</script>
