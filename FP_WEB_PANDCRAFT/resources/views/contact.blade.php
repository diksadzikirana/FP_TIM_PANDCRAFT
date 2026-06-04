<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PandCraft</title>

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

                <a href="/" class="hover:text-brand transition">Home</a>
                <a href="/about" class="hover:text-brand transition">About Us</a>
                <a href="/contact" class="text-brand border-b-2 border-brand pb-1 font-semibold">Contact</a>

            </nav>

        </div>

    </header>

    <main class="flex-1 max-w-7xl mx-auto px-6 py-12 w-full">

        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-brand-dark mb-4">
                Hubungi Kami
            </h1>

            <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                Punya pertanyaan tentang produk kami, pesanan khusus, atau ingin bekerja sama? Jangan ragu untuk menghubungi kami melalui kontak di bawah ini.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 mb-12">

            <div class="lg:w-1/3 flex flex-col justify-center border-r-0 lg:border-r border-gray-200 lg:pr-12">

                <div class="mb-8">
                    <h2 class="text-2xl font-serif font-bold text-brand-dark mb-2">
                        Informasi Kontak
                    </h2>
                    <p class="text-gray-500 text-sm">
                        Tim kami siap membantu Anda dengan sepenuh hati.
                    </p>
                </div>

                <div class="bg-brand-light border border-green-100 rounded-2xl p-6 mb-6">

                    <div class="flex items-center gap-4 mb-6">

                        <div class="w-14 h-14 bg-brand text-white rounded-full flex items-center justify-center text-2xl shadow-md">
                            <i class="fa-regular fa-user"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">
                                Customer Service
                            </p>
                            <h3 class="text-xl font-bold text-brand-dark">
                                Vera
                            </h3>
                        </div>

                    </div>

                    <div class="space-y-4">

                        <a href="https://wa.me/6283122456326" target="_blank"
                           class="flex items-center justify-between bg-white hover:bg-green-50 border border-gray-200 p-4 rounded-xl transition group">

                            <div class="flex items-center gap-3">
                                <i class="fa-brands fa-whatsapp text-2xl text-green-500"></i>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Chat by WhatsApp</p>
                                    <p class="text-xs text-gray-500">0831-2245-6326</p>
                                </div>
                            </div>

                            <i class="fa-solid fa-arrow-right text-gray-400 group-hover:text-brand transition"></i>

                        </a>

                        <a href="https://instagram.com/_vr.ptr" target="_blank"
                           class="flex items-center justify-between bg-white hover:bg-pink-50 border border-gray-200 p-4 rounded-xl transition group">

                            <div class="flex items-center gap-3">
                                <i class="fa-brands fa-instagram text-2xl text-pink-600"></i>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">DM by Instagram</p>
                                    <p class="text-xs text-gray-500">@_vr.ptr</p>
                                </div>
                            </div>

                            <i class="fa-solid fa-arrow-right text-gray-400 group-hover:text-pink-600 transition"></i>

                        </a>

                    </div>
                </div>

                <div class="flex items-start gap-3 text-gray-600 mt-4">
                    <i class="fa-regular fa-clock mt-1 text-brand"></i>
                    <div>
                        <p class="font-medium text-sm">Jam Operasional:</p>
                        <p class="text-sm">Senin - Sabtu (09:00 - 17:00 WIB)</p>
                    </div>
                </div>

            </div>

            <div class="lg:w-2/3 lg:pl-4">

                <h2 class="text-2xl font-serif font-bold text-brand-dark mb-6">
                    Tinggalkan Pesan
                </h2>

                <form action="#" method="POST" class="space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand focus:border-brand outline-none transition bg-gray-50 focus:bg-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                            <input type="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand focus:border-brand outline-none transition bg-gray-50 focus:bg-white">
                        </div>

                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subjek Pesan</label>
                        <select class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand focus:border-brand outline-none transition bg-gray-50 focus:bg-white text-gray-700">

                            <option value="">Pilih topik pertanyaan...</option>
                            <option value="Tanya Produk">Pertanyaan Produk</option>
                            <option value="Pesanan Khusus">Pesanan Khusus (Custom)</option>
                            <option value="Kerja Sama">Kerja Sama / B2B</option>
                            <option value="Lainnya">Lainnya</option>

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pesan Anda</label>
                        <textarea rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand focus:border-brand outline-none transition bg-gray-50 focus:bg-white resize-none"></textarea>
                    </div>

                    <button type="button"
                        class="w-full md:w-auto px-8 py-3 bg-brand text-white font-medium rounded-xl hover:bg-brand-dark transition shadow-lg shadow-green-200">
                        Kirim Pesan
                    </button>

                </form>

            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto py-8">

        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">

            <div class="font-serif font-bold text-brand-dark text-xl">
                PandCraft.
            </div>

            <div class="text-sm text-gray-500">
                &copy; {{ date('Y') }} PandCraft. All rights reserved.
            </div>

            <div class="flex space-x-4 text-gray-400">

                <a href="https://instagram.com/_vr.ptr" target="_blank" class="hover:text-brand transition">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#" class="hover:text-brand transition">
                    <i class="fa-brands fa-facebook"></i>
                </a>

                <a href="https://wa.me/6283122456326" target="_blank" class="hover:text-brand transition">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

            </div>

        </div>

    </footer>

</body>
</html>