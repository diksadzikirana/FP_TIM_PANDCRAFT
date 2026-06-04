<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pembayaran | Admin PandCraft</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); }
        .shopee-shadow { box-shadow: 0 2px 12px 0 rgba(0,0,0,.06); }
    </style>
</head>
<body class="min-h-screen pb-10">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-green-700 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar"></i> Kelola Pembayaran
            </h1>
            <p class="text-gray-500 text-sm">Verifikasi dan perbarui status transaksi keuangan toko Anda.</p>
        </div>
        <a href="{{ url('/owner/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all shadow-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-xl shopee-shadow border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 uppercase text-xs font-bold tracking-wider">
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4">Produk & ID</th>
                        <th class="px-6 py-4">Pembeli</th>
                        <th class="px-6 py-4">Total Harga</th>
                        <th class="px-6 py-4">Metode</th>
                        <th class="px-6 py-4">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($data as $index => $row)
                    <tr class="hover:bg-green-50/50 transition-colors">
                        <td class="px-6 py-5 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-5">
                            <div class="font-bold text-gray-800">{{ $row->nama_produk }}</div>
                            <div class="text-[10px] text-gray-400 mt-0.5 uppercase tracking-tighter">ID Pesanan: #{{ $row->id_pesanan }}</div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-xs mr-3">
                                    {{ strtoupper(substr($row->nama_pembeli, 0, 1)) }}
                                </div>
                                <span class="font-medium text-gray-700">{{ $row->nama_pembeli }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-green-600 font-extrabold text-base">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-2.5 py-1 rounded-md bg-gray-100 text-gray-600 text-[11px] font-bold border border-gray-200 uppercase">{{ $row->metode_bayar }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <form action="{{ route('pembayaran.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_pesanan" value="{{ $row->id_pesanan }}">
                                <select name="status_pembayaran" onchange="this.form.submit()" 
                                    class="block w-full pl-3 pr-10 py-2 text-xs font-bold border-2 rounded-lg cursor-pointer transition-all 
                                    {{ $row->status_pembayaran == 'Pembayaran Berhasil' ? 'bg-green-50 border-green-200 text-green-700' : 'bg-yellow-50 border-yellow-200 text-yellow-700' }}">
                                    <option value="Menunggu Pembayaran" {{ $row->status_pembayaran == 'Menunggu Pembayaran' ? 'selected' : '' }}>🕒 Menunggu Pembayaran</option>
                                    <option value="Pembayaran Berhasil" {{ $row->status_pembayaran == 'Pembayaran Berhasil' ? 'selected' : '' }}>✅ Pembayaran Berhasil</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan='6' class='px-6 py-10 text-center text-gray-400 italic'>Belum ada data pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>