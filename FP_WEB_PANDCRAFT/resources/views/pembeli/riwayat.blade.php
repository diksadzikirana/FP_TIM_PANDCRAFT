<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - PandCraft</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-4 text-green-600">Detail Pesanan</h2>

    <img src="{{ asset('gambar_produk/'.$pesanan->gambar) }}" class="w-40 mb-4 rounded" alt="Produk">

    <p><b>Produk:</b> {{ $pesanan->nama_produk }}</p>
    <p><b>Jumlah:</b> {{ $pesanan->jumlah }}</p>
    <p><b>Total:</b> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
    <p><b>Status Pesanan:</b> {{ $pesanan->status_pesanan }}</p>

    <hr class="my-4">

    <div class="p-4 rounded bg-gray-100">
        <p><b>Metode:</b> {{ $pesanan->metode_bayar }}</p>
        <p><b>Status Pembayaran:</b> {{ $pesanan->status_pembayaran }}</p>
    </div>

    <br>

    @if($pesanan->metode_bayar == "COD")
        <div class="bg-yellow-100 p-4 rounded">
            <p class="font-semibold text-yellow-700">COD</p>
            <p>Bayar saat barang sampai</p>
        </div>
    @else
        <div class="bg-green-100 p-4 rounded">
            <p class="font-semibold text-green-700">Transfer</p>
            <p>Silakan transfer ke:</p>
            <p class="font-bold">BNI - 1234567890</p>
            <p>a.n PandCraft</p>
        </div>
    @endif

    <div class="mt-6 flex justify-center gap-4">
        <a href="{{ url('lihat_pesanan') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
            ← Lihat Pesanan
        </a>
        <a href="{{ url('pembeli/katalog') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">
            Katalog
        </a>
    </div>

</div>
</body>
</html>