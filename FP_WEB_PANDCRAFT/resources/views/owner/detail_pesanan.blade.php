 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan (Admin)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

{{-- max-w-4xl diubah menjadi max-w-2xl agar lebih ramping --}}
<div class="max-w-2xl mx-auto mt-8 bg-white p-5 rounded-lg shadow-sm border border-gray-100">
    
    <h2 class="text-lg font-bold text-green-700 mb-4 border-b pb-2">
        📦 Detail Pesanan
    </h2>

    {{-- Layout produk lebih ringkas --}}
    <div class="flex gap-4 mb-5">
        <img src="{{ asset('gambar_produk/' . $data->gambar) }}" class="w-20 h-20 object-cover rounded shadow-sm">
        <div class="text-sm">
            <p class="font-bold text-gray-800">{{ $data->nama_produk }}</p>
            <p class="text-gray-600">Jumlah: <span class="font-medium">{{ $data->jumlah }}</span></p>
            <p class="text-green-600 font-bold mt-1">Rp {{ number_format($data->total_harga, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Grid untuk data pembeli agar hemat tempat --}}
    <div class="grid grid-cols-1 gap-3 text-sm mb-5">
        <div>
            <p class="text-gray-400 text-xs uppercase font-bold">Data Pembeli</p>
            <p class="font-medium">{{ $data->nama_pembeli }} | {{ $data->no_hp }}</p>
            <p class="text-gray-600 italic">"{{ $data->alamat }}"</p>
        </div>
    </div>

    {{-- Status dan Pembayaran berdampingan --}}
    <div class="grid grid-cols-2 gap-4 text-sm bg-gray-50 p-3 rounded-md">
        <div>
            <p class="text-gray-400 text-xs uppercase font-bold">Status Pesanan</p>
            <p class="font-semibold text-green-700">{{ $data->status_pesanan }}</p>
        </div>
        <div>
            <p class="text-gray-400 text-xs uppercase font-bold">Pembayaran</p>
            <p class="font-medium">{{ $data->metode_bayar ?? '-' }}</p>
            <p class="text-gray-600 text-xs">{{ $data->status_pembayaran ?? 'Belum bayar' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ url('/owner/pesanan') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white text-sm px-4 py-2 rounded transition">
            ← Kembali
        </a>
    </div>
</div>

</body>
</html>   