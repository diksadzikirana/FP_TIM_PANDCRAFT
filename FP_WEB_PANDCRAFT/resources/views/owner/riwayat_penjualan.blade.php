<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<div class="bg-gradient-to-r from-green-600 via-green-500 to-green-50 shadow-md">
    <div class="max-w-5xl mx-auto px-6 py-5 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white flex items-center gap-2 shadow-sm">
            <i class="fas fa-store"></i> Riwayat Penjualan
        </h1>
        <a href="{{ url('/owner/dashboard') }}" class="bg-white text-green-600 hover:bg-gray-100 px-5 py-2 rounded font-bold shadow transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="max-w-5xl mx-auto mt-8 px-4 pb-12">
    <div class="space-y-4">
        @forelse($data as $row)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
            <div class="bg-gray-50 px-6 py-3 border-b border-gray-100 flex justify-between items-center text-sm">
                <div class="font-bold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-circle-user text-gray-400 text-lg"></i>
                    {{ $row->nama_pembeli }}
                </div>
                <div class="text-gray-500 font-medium">
                    <i class="far fa-calendar-alt mr-1"></i> {{ date('d-m-Y', strtotime($row->tgl_pesanan)) }}
                </div>
            </div>

            <div class="px-6 py-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <div class="w-16 h-16 bg-green-50 border border-green-100 rounded flex items-center justify-center text-green-500 flex-shrink-0">
                        <i class="fas fa-box-open text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $row->nama_produk }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Jumlah: <span class="font-semibold text-gray-700">{{ $row->jumlah }} pcs</span></p>
                    </div>
                </div>
                
                <div class="text-left md:text-right border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6 w-full md:w-auto">
                    <p class="text-xs text-gray-500 mb-1">Total Pendapatan</p>
                    <p class="text-xl font-bold text-green-600 mb-2">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</p>
                    
                    <span class="inline-block px-3 py-1 rounded text-xs font-bold border 
                    {{ $row->status_pembayaran == 'Pembayaran Berhasil' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-yellow-50 text-yellow-700 border-yellow-200' }}">
                        {{ $row->status_pembayaran }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-12 text-center rounded-lg shadow-sm border border-gray-200">
            <i class="fas fa-receipt text-6xl text-gray-200 mb-4"></i>
            <h3 class="text-lg font-bold text-gray-500">Belum ada riwayat penjualan</h3>
        </div>
        @endforelse
    </div>
</div>

</body>
</html>