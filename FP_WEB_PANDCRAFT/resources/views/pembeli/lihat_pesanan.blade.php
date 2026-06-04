<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - PandCraft</title>
    
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

<body class="bg-gradient-to-b from-brand-light via-gray-50 to-gray-100 min-h-screen font-sans text-gray-800 antialiased flex flex-col">

    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 shadow-sm border-b border-green-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center h-16 sm:h-20">
            <div class="flex items-center gap-2">
                <div class="text-2xl sm:text-3xl font-extrabold text-green-700 flex items-center gap-2">
                    <i class="fa-solid fa-leaf text-xl"></i>
                    <span class="font-serif hidden sm:inline">PandCraft<span class="text-brand">.</span></span>
                </div>
            </div>
            
            <h1 class="text-lg sm:text-xl font-bold text-gray-800 absolute left-1/2 transform -translate-x-1/2">
                Pesanan Saya
            </h1>

            <a href="{{ url('pembeli/katalog') }}" class="bg-white text-gray-600 border border-gray-300 px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg text-sm sm:text-base font-medium shadow-sm hover:bg-gray-50 hover:text-brand hover:border-brand transition duration-300 flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> <span class="hidden sm:inline">Kembali</span>
            </a>
        </div>
    </nav>

    <main class="flex-1 max-w-4xl mx-auto px-4 w-full py-8 sm:py-10">
        
        <div class="space-y-5">
            @forelse($pesanan as $row)
                @php
                    $status = $row->status_pesanan;
                    $badgeClass = "bg-gray-100 text-gray-600 border-gray-200";
                    
                    if($status == 'Menunggu' || $status == 'Menunggu Pembayaran') {
                        $badgeClass = "text-orange-600 bg-orange-50 border-orange-200";
                    } elseif ($status == 'Diproses' || $status == 'Dikirim') {
                        $badgeClass = "text-blue-600 bg-blue-50 border-blue-200";
                    } elseif ($status == 'Selesai') {
                        $badgeClass = "text-green-600 bg-green-50 border-green-200";
                    }
                @endphp
                
                <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 hover:shadow-md transition-shadow duration-200 overflow-hidden">
                    <div class="px-5 sm:px-6 py-3 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div class="flex items-center gap-3 text-sm">
                            <span class="font-semibold text-gray-800"><i class="fa-solid fa-store text-brand mr-1.5"></i> PandCraft Official</span>
                            <span class="hidden sm:inline-block text-gray-300">|</span>
                            <span class="text-gray-500 hidden sm:inline-block">No. Pesanan: #{{ $row->id_pesanan }}</span>
                        </div>
                        <div class="text-xs sm:text-sm font-semibold uppercase tracking-wider px-3 py-1 border rounded-md {{ $badgeClass }}">
                            {{ $status }}
                        </div>
                    </div>

                    <div class="p-5 sm:px-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-shrink-0 border border-gray-100 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center p-2">
                            <img src="{{ asset('gambar_produk/'.$row->gambar) }}" class="w-full h-full object-contain mix-blend-multiply" alt="{{ $row->nama_produk }}">
                        </div>

                        <div class="flex-1 w-full">
                            <h3 class="text-base sm:text-lg font-medium text-gray-800 line-clamp-2">{{ $row->nama_produk }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Variasi: Anyaman Daun Pandan</p>
                            <p class="text-sm font-medium text-gray-600 mt-1.5">x{{ $row->jumlah }}</p>
                        </div>
                    </div>

                    <div class="px-5 sm:px-6 py-4 border-t border-gray-100 bg-gray-50/30 flex flex-col sm:flex-row justify-between items-end sm:items-center gap-4">
                        <div class="text-xs sm:text-sm text-gray-500 w-full sm:w-auto text-left">
                            Dipesan pada: <span class="text-gray-700 font-medium">{{ date('d M Y, H:i', strtotime($row->tgl_pesanan)) }}</span>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-end sm:items-center gap-4 sm:gap-6 w-full sm:w-auto">
                            <div class="text-right">
                                <span class="text-sm text-gray-500 mr-2">Total Pesanan:</span>
                                <span class="text-xl font-bold text-brand">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</span>
                            </div>
                            
                            <a href="{{ route('riwayat', $row->id_pesanan) }}" class="w-full sm:w-auto text-center bg-brand hover:bg-green-800 text-white px-6 py-2.5 rounded-lg text-sm sm:text-base font-medium transition-colors shadow-sm flex items-center justify-center gap-2">
                                Lihat Detail <i class="fa-solid fa-chevron-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center py-24">
                    <div class="w-28 h-28 bg-brand-light rounded-full flex items-center justify-center mb-5 text-brand opacity-80">
                        <i class="fa-solid fa-file-invoice text-5xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 mt-2 mb-8">Anda belum membuat pesanan apapun saat ini.</p>
                    <a href="{{ url('pembeli/katalog') }}" class="bg-brand text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-800 transition-colors shadow-md">
                        Mulai Belanja Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-6 flex justify-center items-center text-sm text-gray-500 font-medium">
            <p>&copy; {{ date("Y") }} PandCraft. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>