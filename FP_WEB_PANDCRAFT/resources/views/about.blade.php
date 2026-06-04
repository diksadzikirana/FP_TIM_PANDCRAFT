<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - PandCraft</title>

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

<body class="font-sans bg-brand-light min-h-screen flex flex-col text-gray-800">

    <header class="bg-white shadow-sm sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="text-3xl font-serif font-bold text-brand-dark">
                PandCraft<span class="text-brand">.</span>
            </div>

            <nav class="hidden md:flex space-x-8 font-medium text-gray-600">

                <a href="/" class="hover:text-brand transition">
                    Home
                </a>

                <a href="/about" class="text-brand border-b-2 border-brand pb-1 font-semibold">
                    About Us
                </a>

                <a href="/contact" class="hover:text-brand transition">
                    Contact
                </a>

            </nav>

        </div>

    </header>

    <main class="grow max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-col md:flex-row items-center justify-between mb-24 gap-12">

            <div class="md:w-1/2">

                <h1 class="text-5xl font-serif font-bold text-brand-dark leading-tight mb-6">

                    Kisah di Balik
                    <br>

                    <span class="text-brand">
                        PandCraft
                    </span>

                </h1>

                <p class="text-lg text-gray-600 mb-6 leading-relaxed">

                    PandCraft lahir dari kecintaan kami terhadap kekayaan alam dan budaya Nusantara. Kami percaya bahwa setiap helai daun pandan memiliki cerita, dan di tangan para pengrajin lokal, cerita tersebut ditenun menjadi mahakarya yang indah dan fungsional.

                </p>

                <p class="text-lg text-gray-600 mb-8 leading-relaxed">

                    Misi kami adalah menjembatani kearifan lokal dengan gaya hidup modern, sekaligus memberdayakan komunitas pengrajin di desa-desa agar karya mereka dapat dihargai di kancah yang lebih luas.

                </p>

            </div>

            <div class="md:w-1/2 relative">

                <div class="aspect-[4/3 rounded-3xl overflow-hidden shadow-2xl">

                    <img
                        src="{{ asset('images/TasAnyamPandan.jpeg') }}"
                        alt="Tas Anyam Pandan PandCraft"
                        class="w-full h-full object-cover"
                    >

                </div>

                <div class="absolute -bottom-6 -right-6 bg-white p-5 rounded-2xl shadow-lg border-t-4 border-brand">

                    <p class="font-serif font-bold text-brand-dark text-xl">
                        100%
                    </p>

                    <p class="text-sm text-gray-500">
                        Buatan Tangan
                    </p>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl p-10 md:p-16 shadow-sm border border-gray-100 mb-20">

            <div class="text-center mb-16">

                <h2 class="text-3xl font-serif font-bold text-brand-dark mb-4">
                    Pilar Utama Kami
                </h2>

                <p class="text-gray-500 max-w-2xl mx-auto">

                    Tiga fondasi yang selalu kami pegang teguh dalam setiap produk yang kami hasilkan.

                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                <div class="text-center group">

                    <div class="w-20 h-20 mx-auto bg-green-50 rounded-full flex items-center justify-center text-brand text-3xl mb-6 group-hover:bg-brand group-hover:text-white transition duration-300">

                        <i class="fa-solid fa-leaf"></i>

                    </div>

                    <h3 class="text-xl font-bold text-brand-dark mb-3">
                        Ramah Lingkungan
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed">

                        Kami hanya menggunakan bahan baku alami yang dapat diperbarui. Pewarnaan dilakukan menggunakan bahan organik untuk menjaga kelestarian alam.

                    </p>

                </div>

                <div class="text-center group">

                    <div class="w-20 h-20 mx-auto bg-green-50 rounded-full flex items-center justify-center text-brand text-3xl mb-6 group-hover:bg-brand group-hover:text-white transition duration-300">

                        <i class="fa-solid fa-hand-holding-heart"></i>

                    </div>

                    <h3 class="text-xl font-bold text-brand-dark mb-3">
                        Pemberdayaan Lokal
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed">

                        Bekerja sama langsung dengan pengrajin lokal, kami memastikan mereka mendapatkan kompensasi yang adil dan meningkatkan kesejahteraan desa.

                    </p>

                </div>

                <div class="text-center group">

                    <div class="w-20 h-20 mx-auto bg-green-50 rounded-full flex items-center justify-center text-brand text-3xl mb-6 group-hover:bg-brand group-hover:text-white transition duration-300">

                        <i class="fa-solid fa-award"></i>

                    </div>

                    <h3 class="text-xl font-bold text-brand-dark mb-3">
                        Kualitas Autentik
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed">

                        Setiap anyaman melewati proses quality control yang ketat, memastikan detail yang rapi, kuat, dan memiliki nilai seni tinggi yang tahan lama.

                    </p>

                </div>

            </div>

        </div>

    </main>

    <footer class="bg-white border-t border-gray-200 py-8">

        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">

            <div class="font-serif font-bold text-brand-dark text-xl">
                PandCraft.
            </div>

            <div class="text-sm text-gray-500">
                &copy; {{ date('Y') }} PandCraft. All rights reserved.
            </div>

            <div class="flex space-x-4 text-gray-400">

                <a href="#" class="hover:text-brand transition">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#" class="hover:text-brand transition">
                    <i class="fa-brands fa-facebook"></i>
                </a>

                <a href="#" class="hover:text-brand transition">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

            </div>

        </div>

    </footer>

</body>
</html>