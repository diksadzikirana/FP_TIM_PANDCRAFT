<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - PandCraft</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex justify-between items-center px-10 py-5 bg-white shadow">
    <h1 class="text-2xl font-bold text-green-500">Checkout</h1>
    <div>
        <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
            ← Kembali
        </a>
    </div>
</div>

<div class="max-w-6xl mx-auto mt-10 grid md:grid-cols-2 gap-10 pb-20">

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-bold mb-4">Data Pembeli</h2>
        
        <form action="{{ route('proses.pesanan') }}" method="POST">
            @csrf
            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
            <input type="hidden" name="jumlah" value="{{ $jumlah }}">

            <label class="text-sm font-medium">Nama Lengkap</label>
            <input type="text" name="nama" required class="w-full border p-2 rounded mb-3 focus:ring-2 focus:ring-green-400 outline-none">

            <label class="text-sm font-medium">No HP</label>
            <input type="text" name="no_hp" required class="w-full border p-2 rounded mb-3 focus:ring-2 focus:ring-green-400 outline-none">

            <label class="text-sm font-medium">Alamat</label>
            <textarea name="alamat" required class="w-full border p-2 rounded mb-3 focus:ring-2 focus:ring-green-400 outline-none"></textarea>

            <h2 class="text-lg font-bold mt-5 mb-3">Pembayaran</h2>
            <select name="metode" class="w-full border p-2 rounded mb-4 focus:ring-2 focus:ring-green-400 outline-none">
                <option value="COD">COD (Bayar di Tempat)</option>
                <option value="Transfer">Transfer Bank</option>
            </select>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg font-semibold transition-colors">
                Bayar Sekarang
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-xl shadow self-start">
        <h2 class="text-lg font-bold mb-4">Ringkasan Pesanan</h2>

        <div class="flex items-center gap-4 mb-4">
            <img src="{{ asset('gambar_produk/'.$produk->gambar) }}" class="w-20 h-20 object-cover rounded shadow-sm">
            <div>
                <p class="font-semibold">{{ $produk->nama_produk }}</p>
                <p class="text-sm text-gray-500">Qty: {{ $jumlah }}</p>
            </div>
            <div class="ml-auto font-semibold">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </div>
        </div>

        <hr class="my-4">

        <div class="flex justify-between text-sm mb-2">
            <span>Subtotal</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-sm mb-2">
            <span>Ongkir</span>
            <span>Rp 10.000</span>
        </div>

        <hr class="my-3 border-dashed">

        <div class="flex justify-between text-lg font-bold">
            <span>Total</span>
            <span class="text-orange-500">
                Rp {{ number_format($total + 10000, 0, ',', '.') }}
            </span>
        </div>
    </div>

</div>

</body>
</html>