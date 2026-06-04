<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan Admin - PandCraft</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] },
                    colors: { brand: { light: '#fefce8', DEFAULT: '#2e7d32', dark: '#1b4332' } }
                }
            }
        }
    </script>
    <style>
        .custom-select { appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; padding-right: 2.5rem; }
    </style>
</head>

<body class="font-sans bg-brand-light bg-[url('/images/ok.jpeg')] bg-cover bg-fixed bg-center min-h-screen text-gray-800 flex flex-col">
        <nav class="bg-white/95 backdrop-blur-sm border-b border-gray-100 px-8 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-serif font-bold text-gray-800">PandCraft<span class="text-green-700">.</span></h1>
                <span class="text-gray-400 text-sm border-l pl-4 border-gray-300">ADMIN PANEL</span>
            </div>
            <a href="{{ url('admin/dashboard') }}" class="bg-white border border-red-200 text-red-500 px-5 py-2 rounded-lg text-sm font-medium hover:bg-red-50 transition">
                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Keluar
            </a>
        </div>
    </nav>

    <main class="flex-1 p-6">
        <div class="max-w-7xl mx-auto mt-6">
            <div class="flex items-center mb-8">
                <div class="bg-brand text-white p-3 rounded-xl shadow-md shadow-green-200 mr-4">
                    <i class="fa-solid fa-box-open text-xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-serif font-bold text-brand-dark mb-1">Kelola Pesanan</h2>
                    <p class="text-sm text-gray-500">Pantau dan perbarui status pesanan pelanggan Anda di sini.</p>
                </div>
            </div>

            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl border border-green-50 overflow-hidden">
                <table class="w-full text-left border-collapse">
    <thead>
        <tr class="bg-green-50/80 text-brand-dark font-medium border-b border-green-100">
            <th class="px-6 py-5 text-center w-16">No</th>
            <th class="px-6 py-5">Produk</th>
            <th class="px-6 py-5">Pembeli</th>
            <th class="px-6 py-5">Total</th>
            <th class="px-6 py-5">Metode</th> 
            <th class="px-6 py-5 text-center">Status Pesanan</th>
            <th class="px-6 py-5 text-center">Status Pembayaran</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @foreach($data as $no => $row)
        <tr class="hover:bg-green-50/40 transition duration-200">
            <td class="px-6 py-4 text-center text-gray-500">{{ $no + 1 }}</td>
            <td class="px-6 py-4"><span class="font-semibold text-gray-800">{{ $row->nama_produk }}</span></td>
            <td class="px-6 py-4 text-gray-600">{{ $row->nama_pembeli }}</td>
            <td class="px-6 py-4"><span class="text-brand font-bold">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</span></td>
            
            <td class="px-6 py-4">
                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                    {{ $row->metode_bayar }}
                </span>
            </td>
            
            <td class="px-6 py-4 text-center">
                <form action="{{ url('/admin/pesanan/update-status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $row->id_pesanan }}">
                    <select name="status" onchange="this.form.submit()" class="custom-select w-full max-w-[160px] cursor-pointer border-2 font-medium text-sm px-4 py-2.5 rounded-full {{ $row->status_pesanan == 'Menunggu' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($row->status_pesanan == 'Dikirim' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-green-50 text-green-700 border-green-200') }}">
                        <option value="Menunggu" {{ $row->status_pesanan == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Dikirim" {{ $row->status_pesanan == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="Selesai" {{ $row->status_pesanan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </form>
            </td>

            <td class="px-6 py-4 text-center">
                <form action="{{ url('/admin/pesanan/update-pembayaran') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $row->id_pesanan }}">
                    <select name="status_pembayaran" onchange="this.form.submit()" class="custom-select w-full max-w-[200px] cursor-pointer border-2 font-medium text-sm px-4 py-2.5 rounded-full {{ $row->status_pembayaran == 'Pembayaran Berhasil' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                        <option value="Menunggu Pembayaran" {{ $row->status_pembayaran == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="Pembayaran Berhasil" {{ $row->status_pembayaran == 'Pembayaran Berhasil' ? 'selected' : '' }}>Pembayaran Berhasil</option>
                    </select>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
            <div class="mt-12 text-center text-gray-400 text-sm">
                &copy; 2026 PandCraft. Hak Cipta Dilindungi.
            </div>
        </div>
    </main>

</body>
</html>