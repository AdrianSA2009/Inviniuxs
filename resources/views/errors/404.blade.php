<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found - GudangPro Elektronik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 bg-slate-900 rounded-3xl overflow-hidden shadow-2xl shadow-blue-900/20 border border-slate-800" data-aos="zoom-in">
        
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
                        Oops! <br>
                        <span class="text-blue-200">Ada yang salah.</span>
                    </h2>
                    <p class="text-blue-100/80 text-lg leading-relaxed max-w-xs">
                        Mari kita kembali ke jalur yang benar dan lanjutkan pekerjaan Anda.
                    </p>
                </div>
            </div>

            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-400/20 rounded-full blur-2xl"></div>
        </div>

        <div class="p-8 md:p-15 bg-slate-900 flex flex-col justify-center items-center text-center">
            <div class="mb-8" data-aos="fade-down" data-aos-delay="300">
                <div class="inline-block bg-slate-800/50 p-6 rounded-full mb-6 border border-slate-700">
                    <i class="fas fa-map-signs text-5xl text-blue-500"></i>
                </div>
                <h1 class="text-6xl font-extrabold text-white mb-2 tracking-tight">404</h1>
                <h3 class="text-2xl font-bold text-slate-200 mb-3">Halaman Tidak Ditemukan</h3>
                <p class="text-slate-400 leading-relaxed max-w-sm mx-auto">
                    Maaf, halaman yang Anda tuju mungkin telah dihapus, namanya diubah, atau tidak tersedia untuk saat ini.
                </p>
            </div>

            <div class="w-full max-w-xs" data-aos="fade-up" data-aos-delay="500">
                <a href="{{ url('/') }}" 
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl shadow-xl shadow-blue-900/30 transition-all active:scale-[0.97] flex items-center justify-center gap-3">
                    <i class="fas fa-home"></i>
                    <span>Kembali ke Login</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, easing: 'ease-in-out' });
    </script>
</body>
</html>