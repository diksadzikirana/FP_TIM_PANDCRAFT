<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - PandCraft</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

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
                            light: '#e8f5e9',
                            DEFAULT: '#2e7d32',
                            dark: '#1b4332',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-b from-brand-light via-white to-gray-50 min-h-screen font-sans antialiased flex flex-col text-gray-800">

    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 shadow-sm border-b border-green-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 sm:h-20">
                <div class="flex items-center gap-2 cursor-pointer">
                    <div class="bg-brand text-white p-2 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-leaf text-xl"></i>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-brand-dark tracking-tight">
                        PandCraft<span class="text-brand">.</span>
                    </h1>
                </div>

                <div class="flex items-center gap-3 sm:gap-4">
                    <a href="{{ url('lihat_pesanan') }}" class="flex items-center gap-2 text-sm sm:text-base font-medium text-gray-700 hover:text-brand bg-gray-50 hover:bg-brand-light border border-gray-200 hover:border-green-300 px-4 py-2 sm:px-5 sm:py-2.5 rounded-full transition-all duration-300">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="hidden sm:inline">Pesanan Saya</span>
                    </a>
                    <a href="{{ url('/logoutpembeli') }}" class="relative z-[60] flex items-center gap-2 text-sm sm:text-base font-medium text-white bg-red-500 hover:bg-red-600 px-4 py-2 sm:px-5 sm:py-2.5 rounded-full shadow-sm shadow-red-200 transition-all duration-300">
                     <i class="fa-solid fa-arrow-right-from-bracket"></i>
                     <span class="hidden sm:inline">Keluar</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-8 pb-16">
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between border-b border-gray-200 pb-6 gap-4">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-brand-dark mb-2">Eksplorasi Produk</h2>
                <p class="text-gray-500 text-sm sm:text-base">Temukan keindahan kerajinan tangan daun pandan berkualitas tinggi.</p>
            </div>
            <form action="{{ url('/pembeli/katalog') }}" method="GET" class="relative w-full md:w-64">
                <input type="text" 
                  name="search" 
                  value="{{ request()->input('search') }}" 
                  placeholder="Cari kerajinan..." 
                  class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent bg-white shadow-sm">
                     <button type="submit" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-5">
            @forelse($data as $row)
            <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] hover:shadow-[0_8px_20px_-6px_rgba(46,125,50,0.2)] border border-gray-100 hover:border-green-200 transition-all duration-300 overflow-hidden flex flex-col group">
                <div class="relative w-full aspect-square overflow-hidden bg-gray-50 flex items-center justify-center p-3">
                    @if($row->stok <= 0)
                        <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] z-10 flex items-center justify-center">
                            <span class="bg-gray-800 text-white font-semibold px-4 py-1.5 rounded-full text-sm shadow-md tracking-wider">HABIS</span>
                        </div>
                    @endif
                    <img src="{{ asset('gambar_produk/'.$row->gambar) }}" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500 ease-out" alt="{{ $row->nama_produk }}">
                </div>

                <div class="p-4 flex flex-col flex-1 bg-white">
                    <h3 class="text-gray-800 font-medium text-sm sm:text-base line-clamp-2 h-10 sm:h-12 leading-snug group-hover:text-brand transition-colors">
                        {{ $row->nama_produk }}
                    </h3>
                    <div class="mt-auto pt-3 flex flex-col gap-1">
                        <div class="text-brand font-bold text-lg sm:text-xl">
                            Rp {{ number_format($row->harga, 0, ',', '.') }}
                        </div>
                        <div class="flex items-center justify-between mt-1">
                            <div class="text-xs text-gray-500 flex items-center gap-1.5">
                                <i class="fa-solid fa-cubes text-gray-400"></i> Sisa: {{ $row->stok }}
                            </div>
                            <span class="text-[10px] uppercase tracking-wider bg-brand-light text-brand-dark px-2 py-0.5 rounded-md font-semibold">Ori</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if($row->stok > 0)
                            <a href="{{ url('detail_produk/'.$row->id_produk) }}" class="w-full text-center bg-brand hover:bg-brand-dark text-white font-medium py-2 sm:py-2.5 rounded-lg text-sm sm:text-base transition-colors shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                                <i class="fa-solid fa-cart-plus"></i> Beli
                            </a>
                        @else
                            <button class="block w-full text-center bg-gray-100 text-gray-400 font-medium py-2 sm:py-2.5 rounded-lg text-sm sm:text-base cursor-not-allowed border border-gray-200" disabled>Stok Kosong</button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full py-20 text-center flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400 text-4xl">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700">Belum ada produk</h3>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500 font-medium">&copy; {{ date('Y') }} PandCraft. Hak Cipta Dilindungi.</p>
            <div class="flex gap-4 text-gray-400">
                <i class="fa-brands fa-instagram hover:text-brand cursor-pointer transition-colors text-xl"></i>
                <i class="fa-brands fa-whatsapp hover:text-brand cursor-pointer transition-colors text-xl"></i>
                <i class="fa-brands fa-facebook hover:text-brand cursor-pointer transition-colors text-xl"></i>
            </div>
        </div>
    </footer>

</body>
</html>