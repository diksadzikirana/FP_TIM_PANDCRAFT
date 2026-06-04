<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $produk->nama_produk }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex justify-between items-center px-10 py-5 bg-white shadow">
    <h1 class="text-2xl font-bold text-green-700">Katalog</h1>
    <div class="space-x-6 text-gray-600">
        <a href="{{ url('/pembeli/katalog') }}">Kembali</a>
    </div>
</div>

<div class="max-w-6xl mx-auto mt-10 grid md:grid-cols-2 gap-10">

    <div class="bg-white p-6 rounded-xl shadow flex items-center justify-center">
        <img src="{{ asset('gambar_produk/'.$produk->gambar) }}" 
        class="h-80 object-contain" alt="{{ $produk->nama_produk }}">
    </div>

    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-2">{{ $produk->nama_produk }}</h2>

        <p class="text-gray-500 mb-3">Produk kerajinan daun pandan berkualitas</p>

        <p class="text-3xl font-bold text-green-600 mb-4">
            Rp {{ number_format($produk->harga, 0, ',', '.') }}
        </p>

        <p class="text-sm text-gray-500 mb-4">
            Stok tersedia: {{ $produk->stok }}
        </p>

        <form action="{{ url('checkout') }}" method="POST">
            @csrf
            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

            <label class="font-semibold">Jumlah</label>
            <input type="number" name="jumlah" 
            min="1" max="{{ $produk->stok }}"
            required
            class="w-full border p-2 rounded mt-1 mb-4">

            <button type="submit"
            class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg text-lg font-semibold">
                Beli Sekarang
            </button>
        </form>

        <div class="mt-6 border-t pt-4 text-sm text-gray-500">
            <p>✔ Produk handmade</p>
            <p>✔ Bahan daun pandan asli</p>
            <p>✔ Kualitas terbaik</p>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto mt-10 mb-10 bg-white p-6 rounded-xl shadow">
    <h3 class="text-xl font-bold mb-3">Deskripsi Produk</h3>
    <p class="text-gray-600">
        Produk ini merupakan kerajinan tangan berbahan dasar daun pandan 
        yang dibuat dengan teknik anyaman tradisional. Cocok digunakan 
        untuk kebutuhan sehari-hari maupun souvenir.
    </p>
</div>

</body>
</html>