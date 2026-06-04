<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website PandCraft - Crafted with Love</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

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

<body class="font-sans bg-brand-light min-h-screen flex flex-col text-gray-800">

    <!-- HEADER -->

    <header class="bg-white shadow-sm sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="text-3xl font-serif font-bold text-brand-dark">
                PandCraft<span class="text-brand">.</span>
            </div>

            <nav class="hidden md:flex space-x-8 font-medium text-gray-600">

                <a href="/" class="text-brand border-b-2 border-brand pb-1 font-semibold">
                    Home
                </a>

                <a href="/about" class="hover:text-brand transition">
                    About Us
                </a>

                <a href="/contact" class="hover:text-brand transition">
                    Contact
                </a>

            </nav>

        </div>

    </header>

    <!-- MAIN -->

    <main class="grow max-w-7xl mx-auto px-6 py-12">

        <!-- HERO -->

        <section class="flex flex-col md:flex-row items-center justify-between mb-20 gap-12">

            <div class="md:w-1/2">

                <h1 class="text-5xl md:text-6xl font-serif font-bold text-brand-dark leading-tight mb-6">

                    Crafted with Love,
                    <br>
                    Rooted in
                    <span class="text-brand">Tradition</span>

                </h1>

                <p class="text-lg text-gray-600 mb-8 leading-relaxed">

                    Jelajahi koleksi kerajinan anyaman autentik kami yang dibuat langsung oleh tangan-tangan terampil pengrajin lokal.

                </p>

            </div>

            <div class="md:w-1/2 relative">

                <div class="rounded-2xl overflow-hidden shadow-2xl">

                    <img
                        src="{{ asset('images/anyam.png') }}"
                        alt="Pengrajin Anyaman"
                        class="w-full h-full object-cover"
                    >

                </div>

                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-lg font-serif italic text-brand-dark border-l-4 border-brand">

                    "Karya Seni Nusantara"

                </div>

            </div>

        </section>

        <!-- ROLE CARD -->

        <section class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100">

            <div class="mb-10 text-center md:text-left">

                <h2 class="text-3xl font-serif font-bold text-brand-dark mb-3">

                    Selamat Datang di PandCraft

                </h2>

                <p class="text-gray-500">

                    Silakan pilih portal akses sesuai dengan peran Anda:

                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- OWNER -->

                <div class="bg-white border-2 border-gray-100 hover:border-brand rounded-2xl p-6 transition duration-300 flex flex-col shadow-sm hover:shadow-md group">

                    <div class="flex items-center gap-4 mb-6">

                        <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-brand text-2xl group-hover:bg-brand group-hover:text-white transition">

                            <i class="fa-solid fa-store"></i>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-brand-dark">

                                Akses Pemilik

                            </h3>

                            <span class="text-sm text-gray-500">

                                (Owner Toko)

                            </span>

                        </div>

                    </div>

                    <ul class="text-sm text-gray-600 space-y-3 mb-8 grow">

                        <li>
                            <i class="fa-solid fa-check text-brand mr-2"></i>
                            Management Dashboard
                        </li>

                        <li>
                            <i class="fa-solid fa-check text-brand mr-2"></i>
                            Product Catalog
                        </li>

                        <li>
                            <i class="fa-solid fa-check text-brand mr-2"></i>
                            Inventory Monitoring
                        </li>

                    </ul>

                    <a
                        href="/owner/login"
                        class="w-full block text-center bg-brand text-white font-medium py-3 rounded-xl hover:bg-brand-dark transition shadow-lg shadow-green-200"
                    >

                        Masuk ke Dashboard

                    </a>

                </div>

                <!-- BUYER -->

                <div class="bg-white border-2 border-gray-100 hover:border-brand rounded-2xl p-6 transition duration-300 flex flex-col shadow-sm hover:shadow-md group">

                    <div class="flex items-center gap-4 mb-6">

                        <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-brand text-2xl group-hover:bg-brand group-hover:text-white transition">

                            <i class="fa-solid fa-basket-shopping"></i>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-brand-dark">

                                Pelanggan

                            </h3>

                            <span class="text-sm text-gray-500">

                                (Buyer)

                            </span>

                        </div>

                    </div>

                    <ul class="text-sm text-gray-600 space-y-3 mb-8 grow">

                        <li>
                            <i class="fa-solid fa-check text-brand mr-2"></i>
                            Jelajahi Koleksi Unik
                        </li>

                        <li>
                            <i class="fa-solid fa-check text-brand mr-2"></i>
                            Transaksi Aman
                        </li>

                        <li>
                            <i class="fa-solid fa-check text-brand mr-2"></i>
                            Lacak Pesanan Anda
                        </li>

                    </ul>

                    <a
                        href="/pembeli/login"
                        class="w-full block text-center bg-brand text-white font-medium py-3 rounded-xl hover:bg-brand-dark transition shadow-lg shadow-green-200"
                    >

                        Mulai Belanja

                    </a>

                </div>

                <!-- ADMIN -->

                <div class="bg-white border-2 border-gray-100 hover:border-brand rounded-2xl p-6 transition duration-300 flex flex-col shadow-sm hover:shadow-md group">

                    <div class="flex items-center gap-4 mb-6">

                        <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 text-2xl group-hover:bg-gray-800 group-hover:text-white transition">

                            <i class="fa-solid fa-shield-halved"></i>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-brand-dark">

                                Admin Sistem

                            </h3>

                            <span class="text-sm text-gray-500">

                                (Administrator)

                            </span>

                        </div>

                    </div>

                    <ul class="text-sm text-gray-600 space-y-3 mb-8 grow">

                        <li>
                            <i class="fa-solid fa-check text-gray-400 mr-2"></i>
                            Konfigurasi Sistem
                        </li>

                        <li>
                            <i class="fa-solid fa-check text-gray-400 mr-2"></i>
                            Manajemen Pengguna
                        </li>

                        <li>
                            <i class="fa-solid fa-check text-gray-400 mr-2"></i>
                            Panel Keamanan
                        </li>

                    </ul>

                    <a
                        href="/admin/login"
                        class="w-full block text-center bg-gray-800 text-white font-medium py-3 rounded-xl hover:bg-black transition shadow-lg shadow-gray-200"
                    >

                        Akses Panel Admin

                    </a>

                </div>

            </div>

        </section>

    </main>

    <!-- FOOTER -->

    <footer class="bg-white border-t border-gray-200 mt-12 py-8">

        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">

            <div class="font-serif font-bold text-brand-dark text-xl">
                PandCraft.
            </div>

            <div class="text-sm text-gray-500">
                &copy; {{ date('Y') }} PandCraft. All rights reserved.
            </div>

            <div class="flex space-x-4 text-gray-400">

                <a href="#" class="hover:text-brand">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#" class="hover:text-brand">
                    <i class="fa-brands fa-facebook"></i>
                </a>

                <a href="#" class="hover:text-brand">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

            </div>

        </div>

    </footer>

</body>
</html>