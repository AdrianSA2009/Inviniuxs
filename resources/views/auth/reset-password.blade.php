<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Inviniux</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-slate-900 rounded-3xl p-8 border border-slate-800 shadow-2xl">
        <div class="mb-6 text-center">
            <h3 class="text-2xl font-bold text-white mb-2">Buat Password Baru</h3>
            <p class="text-slate-400 text-sm">Silakan tentukan kata sandi baru untuk akun Anda.</p>
        </div>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Password Baru</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-key"></i>
                    </span>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" 
                        class="w-full placeholder:text-slate-500 bg-slate-800/40 border @error('password') border-red-500 @else border-slate-700 @enderror text-white text-sm rounded-xl px-11 py-4 outline-none focus:ring-2 focus:ring-blue-500/50" required>
                </div>
                @error('password')
                    <p class="text-red-400 text-xs mt-2 font-semibold"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Konfirmasi Password Baru</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" 
                        class="w-full placeholder:text-slate-500 bg-slate-800/40 border border-slate-700 text-white text-sm rounded-xl px-11 py-4 outline-none focus:ring-2 focus:ring-blue-500/50" required>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl transition-all shadow-lg flex items-center justify-center gap-2 mt-4">
                    <span>Perbarui Password & Login</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>

</body>
</html>