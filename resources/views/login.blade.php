<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GudangPro Elektronik</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
        }
        .bg-dots {
            background-image: radial-gradient(#ffffff33 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.5);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 bg-slate-900 rounded-3xl overflow-hidden shadow-2xl shadow-blue-900/20 border border-slate-800" data-aos="zoom-in">
        
        <!-- Bagian Kiri -->
        <div class="hidden md:flex flex-col justify-between p-12 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-dots opacity-30"></div>
            
            <div class="z-10">
                <div class="flex items-center gap-3 mb-12" data-aos="fade-down" data-aos-delay="200">
                    <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md border border-white/30">
                        <i class="fas fa-laptop-code text-white text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight">Inviniux</h1>
                </div>

                <div data-aos="fade-right" data-aos-delay="400">
                    <h2 class="text-4xl font-extrabold leading-tight mb-6">
                        Kendali Penuh dalam <br>
                        <span class="text-blue-200">Satu Genggaman.</span>
                    </h2>
                    <p class="text-blue-100/80 text-lg leading-relaxed max-w-xs">
                        Platform manajemen stock gudang elektronik.
                    </p>
                </div>
            </div>

            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-400/20 rounded-full blur-2xl"></div>
        </div>

        <!-- Bagian Kanan -->
        <div class="p-8 md:p-15 bg-slate-900 flex flex-col justify-center">
            <div class="mb-10 text-center md:text-left">
                <h3 class="text-3xl font-bold text-white mb-2">Selamat Datang Kembali!</h3>
                <p class="text-slate-400">Silahkan masuk ke akun anda.</p>
            </div>

            <form action="#" class="space-y-6">
                <div data-aos="fade-up" data-aos-delay="300">
                    <label class="block text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Username</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-user-shield"></i>
                        </span>
                        <input type="text" placeholder="Masukkan username" 
                            class="w-full bg-slate-800/40 border border-slate-700 text-white text-sm rounded-xl px-11 py-4 outline-none transition-all input-focus hover:border-slate-600" required>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="400">
                    <label class="block text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Password</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-key"></i>
                        </span>
                        <input type="password" id="passwordInput" placeholder="••••••••" 
                            class="w-full bg-slate-800/40 border border-slate-700 text-white text-sm rounded-xl px-11 py-4 outline-none transition-all input-focus hover:border-slate-600" required>
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-500 hover:text-white transition-colors">
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="500">
                    <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl shadow-xl shadow-blue-900/30 transition-all active:scale-[0.97] flex items-center justify-center gap-3">
                        <span>Masuk Dashboard</span>
                        <i class="fas fa-sign-in-alt"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out'
        });

        // Show/Hide Password
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('passwordIcon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>