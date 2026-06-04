<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PandCraft</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        brand: {
                            light: '#f0fdf4',
                            DEFAULT: '#2e7d32',
                            dark: '#1b4332',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-brand-light bg-[url('/images/ok.jpeg')] bg-cover bg-fixed bg-center min-h-screen text-gray-800 flex flex-col">

    <nav class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-green-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="text-2xl font-serif font-bold text-brand-dark">
                    PandCraft<span class="text-brand">.</span>
                </div>
                <div class="h-6 w-px bg-gray-300"></div>
                <span class="text-sm font-medium text-gray-500 tracking-wide uppercase">
                    Panel Admin
                </span>
            </div>

            <a href="/logoutadmin"
                class="flex items-center gap-2 text-sm font-medium text-red-500 hover:text-white border border-red-200 hover:bg-red-500 hover:border-red-500 px-5 py-2.5 rounded-xl transition duration-300 shadow-sm">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Keluar
            </a>
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center p-6">
        <div class="max-w-5xl w-full">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-brand-dark mb-4">
                    Selamat Datang, Admin
                </h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Kelola operasional harian PandCraft. Silakan pilih menu di bawah ini untuk memulai.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                
                <a href="{{ url('/admin/produk') }}"
                    class="group block bg-white/90 backdrop-blur-sm p-8 rounded-3xl shadow-lg hover:shadow-2xl border border-green-50 transition-all duration-300 hover:-translate-y-1.5 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-100 rounded-bl-full -mr-8 -mt-8 opacity-50 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-start gap-6 relative z-10">
                        <div class="bg-brand text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-md group-hover:bg-brand-dark transition-colors">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-brand transition-colors">Kelola Produk</h3>
                            <p class="text-gray-500 leading-relaxed">Tambah atau edit data produk kerajinan anyaman PandCraft.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/admin/lihatpesanan') }}"
                    class="group block bg-white/90 backdrop-blur-sm p-8 rounded-3xl shadow-lg hover:shadow-2xl border border-green-50 transition-all duration-300 hover:-translate-y-1.5 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-bl-full -mr-8 -mt-8 opacity-50 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-start gap-6 relative z-10">
                        <div class="bg-blue-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-md group-hover:bg-blue-700 transition-colors">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">Lihat Pesanan</h3>
                            <p class="text-gray-500 leading-relaxed">Lihat daftar pesanan pelanggan.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/admin/pesanan') }}" 
                    class="group block bg-white/90 backdrop-blur-sm p-8 rounded-3xl shadow-lg hover:shadow-2xl border border-green-50 transition-all duration-300 hover:-translate-y-1.5 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100 rounded-bl-full -mr-8 -mt-8 opacity-50 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-start gap-6 relative z-10">
                        <div class="bg-amber-500 text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-md group-hover:bg-amber-600 transition-colors">
                            <i class="fa-solid fa-money-check-dollar"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-amber-600 transition-colors"> Ubah Status Pembayaran</h3>
                            <p class="text-gray-500 leading-relaxed">Verifikasi status pembayaran pelanggan.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/admin/grafik') }}"
                    class="group block bg-white/90 backdrop-blur-sm p-8 rounded-3xl shadow-lg hover:shadow-2xl border border-green-50 transition-all duration-300 hover:-translate-y-1.5 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-purple-100 rounded-bl-full -mr-8 -mt-8 opacity-50 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-start gap-6 relative z-10">
                        <div class="bg-purple-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-md group-hover:bg-purple-700 transition-colors">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition-colors">Grafik Penjualan</h3>
                            <p class="text-gray-500 leading-relaxed">Pantau performa toko dan statistik penjualan.</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} PandCraft. Hak Cipta Dilindungi.
    </footer>

</body>
</html>