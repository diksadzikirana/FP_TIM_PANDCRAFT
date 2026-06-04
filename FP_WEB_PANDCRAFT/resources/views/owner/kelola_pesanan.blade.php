<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-green-50 via-white to-gray-50 min-h-screen text-gray-800 font-sans antialiased">

<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 pb-6 border-b border-green-200 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-green-700 flex items-center gap-3 tracking-tight">
                <i class="fa-solid fa-boxes-stacked text-2xl"></i> Kelola Pesanan
            </h1>
            <p class="text-sm text-gray-500 mt-2 ml-1">Pantau dan kelola semua pesanan pelanggan Anda di sini.</p>
        </div>
        <a href="{{ url('owner/dashboard') }}" class="bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    {{-- Section Perlu Diproses --}}
    <div class="mb-14">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-yellow-100 p-2.5 rounded-lg text-yellow-600">
                <i class="fa-solid fa-bell text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">
                Perlu Diproses <span class="text-sm font-medium bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full ml-2 align-middle">Menunggu</span>
            </h2>
        </div>

        @if($pesan_masuk->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 text-center flex flex-col items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486831.png" alt="Kosong" class="w-24 h-24 opacity-30 mb-4 grayscale">
                <p class="text-gray-500 font-medium text-lg">Hore! Tidak ada pesanan baru yang tertunda.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pesan_masuk as $row)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden transition-all flex flex-col h-full relative">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-yellow-400"></div>
                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-gray-900 text-lg line-clamp-2">{{ $row->nama_produk }}</h3>
                            <span class="bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-bold px-2.5 py-1 rounded-md">Baru</span>
                        </div>
                        <div class="space-y-2 mt-4 text-sm text-gray-600">
                            <p><i class="fa-solid fa-user text-gray-400 w-4"></i> {{ $row->nama_pembeli }}</p>
                            <p><i class="fa-solid fa-hashtag text-gray-400 w-4"></i> ID: #{{ str_pad($row->id_pesanan, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="mt-5 pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-500">Total Belanja</p>
                            <p class="text-xl font-extrabold text-green-600">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 border-t">
                        <a href="{{ url('admin/detail-pesanan/' . $row->id_pesanan) }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg text-sm font-semibold transition">
                            Lihat Pesanan <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Section Semua Riwayat --}}
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-green-100 p-2.5 rounded-lg text-green-700">
                <i class="fa-solid fa-list-check text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Semua Riwayat Pesanan</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-green-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-green-50 text-green-800 uppercase font-bold text-xs border-b border-green-100">
                        <tr>
                            <th class="py-4 px-6 text-center">No</th>
                            <th class="py-4 px-6">Informasi Produk</th>
                            <th class="py-4 px-6">Nama Pembeli</th>
                            <th class="py-4 px-6">Total Tagihan</th>
                            <th class="py-4 px-6 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @foreach($semua as $index => $row)
                        <tr class="hover:bg-green-50/50 transition-colors">
                            <td class="py-4 px-6 text-center text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-900">{{ $row->nama_produk }}</div>
                                <div class="text-xs text-gray-400 mt-1">ID: #{{ str_pad($row->id_pesanan, 4, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td class="py-4 px-6">{{ $row->nama_pembeli }}</td>
                            <td class="py-4 px-6 font-bold text-green-600">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-center">
                                @php
                                    $status = $row->status_pesanan;
                                    $c = [
                                        'Menunggu' => ['bg' => 'bg-yellow-100 border-yellow-200', 'text' => 'text-yellow-700', 'icon' => 'fa-clock'],
                                        'Dikirim'  => ['bg' => 'bg-blue-100 border-blue-200', 'text' => 'text-blue-700', 'icon' => 'fa-truck-fast'],
                                        'Selesai'  => ['bg' => 'bg-green-100 border-green-200', 'text' => 'text-green-700', 'icon' => 'fa-circle-check']
                                    ][$status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => 'fa-question'];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold border {{ $c['bg'] }} {{ $c['text'] }}">
                                    <i class="fa-solid {{ $c['icon'] }}"></i> {{ $status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>