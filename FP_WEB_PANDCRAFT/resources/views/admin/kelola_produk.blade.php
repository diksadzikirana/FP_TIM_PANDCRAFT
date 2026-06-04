<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - PandCraft</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

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

<style>
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
    }
</style>


</head>

<body class="font-sans bg-brand-light bg-[url('/images/ok.jpeg')] bg-cover bg-fixed bg-center min-h-screen text-gray-800 flex flex-col">


<nav class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-green-100">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <div class="flex items-center gap-3">

            <div class="text-2xl font-serif font-bold text-brand-dark">
                PandCraft<span class="text-brand">.</span>
            </div>

            <div class="h-6 w-px bg-gray-300"></div>

            <span class="text-sm font-medium text-gray-500 tracking-wide uppercase">
                Panel Admin
            </span>

        </div>

        @php $routePrefix = session('role') == 'admin' ? '/admin' : '/owner'; @endphp
        <a href="{{ url($routePrefix . '/dashboard') }}"
           class="flex items-center gap-2 text-sm font-medium text-brand-dark hover:text-brand bg-green-50 hover:bg-green-100 border border-green-200 px-5 py-2.5 rounded-xl transition duration-300 shadow-sm">

            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Dashboard

        </a>

    </div>

</nav>

<main class="flex-1 p-6">

    <div class="max-w-6xl mx-auto mt-6">

        <div class="flex items-center mb-8">

            <div class="bg-brand text-white w-14 h-14 rounded-2xl flex items-center justify-center shadow-md shadow-green-200 mr-4 text-2xl">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>

            <div>
                <h2 class="text-3xl font-serif font-bold text-brand-dark mb-1">
                    Kelola Produk
                </h2>

                <p class="text-sm text-gray-500">
                    Tambah, edit, atau hapus data produk kerajinan PandCraft.
                </p>
            </div>

        </div>

        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl border border-green-50 overflow-hidden mb-10">

            <div class="bg-green-50/50 px-8 py-5 border-b border-green-100 flex items-center gap-3">

                <i class="fa-solid fa-pen-to-square text-brand"></i>

                <h3 class="text-lg font-semibold text-brand-dark">
                    Formulir Produk
                </h3>

            </div>

            <form action="{{ url($routePrefix . '/produk/simpan') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-8">

                @csrf

                <input
                type="hidden"
                 name="id_produk"
                 value="{{ $edit->id_produk ?? '' }}"
                    >

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Produk
                        </label>

                        <select name="nama_produk"
                                id="nama_produk"
                                required
                                class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors bg-white">

                            <option value="">-- Pilih Produk --</option>
                            <option value="Tas Anyam Pandan"
                                {{ ($edit->nama_produk ?? '') == 'Tas Anyam Pandan' ? 'selected' : '' }}>
                                  Tas Anyam Pandan
                            </option>
                            <option value="Keranjang Anyam Pandan"
                                {{ ($edit->nama_produk ?? '') == 'Keranjang Anyam Pandan' ? 'selected' : '' }}>
                                 Keranjang Anyam Pandan
                            </option>
                            <option value="Dompet Anyam Pandan"
                                {{ ($edit->nama_produk ?? '') == 'Dompet Anyam Pandan' ? 'selected' : '' }}>
                               Dompet Anyam Pandan
                            </option>
                            <option value="Tikar Anyam Pandan"
                                {{ ($edit->nama_produk ?? '') == 'Tikar Anyam Pandan' ? 'selected' : '' }}>
                                 Tikar Anyam Pandan
                            </option>
                            
                        </select>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga (Rp)
                        </label>

                        <div class="relative">

                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium">
                                Rp
                            </span>

                            <input
                             type="number"
                                name="harga"
                                id="harga"
                                value="{{ $edit->harga ?? '' }}"
                                   
                                   placeholder="Contoh: 50000"
                                   class="w-full border border-gray-300 pl-12 pr-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors"
                                >
                        </div>
                                    @error('harga')
                    <div class="mt-2 text-sm text-red-600">
                     {{ $message }}
                    </div>
                    @enderror
                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Status Produk
                        </label>

                        <select name="status_produk"
                                id="status_produk"
                                onchange="toggleStok()"
                                required
                                class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors bg-white">

                           <option value="Tersedia"
                            {{ ($edit->status_produk ?? '') == 'Tersedia' ? 'selected' : '' }}>
                               Tersedia
                            </option>

                        <option value="Tidak Tersedia"
                            {{ ($edit->status_produk ?? '') == 'Tidak Tersedia' ? 'selected' : '' }}>
                                  Tidak Tersedia
                        </option>

                        </select>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah Stok
                        </label>

                       <input
                        type="number"
                        name="stok"
                         id="stok"
                        value="{{ $edit->stok ?? '' }}"
                               
                               placeholder="0"
                               class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors disabled:bg-gray-100 disabled:text-gray-400">
                         @error('stok')
                    <div class="mt-2 text-sm text-red-600">
                     {{ $message }}
                    </div>
                    @enderror
                    </div>
                           
                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Produk (Biarkan kosong jika tidak diubah)
                        </label>

                        <input type="file"
                               name="gambar"
                               accept="image/*"
                               class="w-full text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-brand hover:file:bg-green-100 transition-colors border border-gray-300 rounded-xl bg-white cursor-pointer">

                    </div>

                </div>

                <div class="mt-8 flex gap-4 pt-6 border-t border-gray-100">

                    <button type="submit"
                            class="bg-brand hover:bg-brand-dark text-white font-medium px-8 py-3 rounded-xl shadow-md shadow-green-200 transition-all duration-300 flex items-center gap-2">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Data

                    </button>

                    <a href="{{ url($routePrefix . '/produk') }}"
                            class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-8 py-3 rounded-xl transition-all duration-300 flex items-center gap-2">

                        <i class="fa-solid fa-rotate-left"></i>
                        Batal / Reset

</a>

                </div>

            </form>

        </div>

        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl border border-green-50 overflow-hidden mb-8">

            <div class="bg-green-50/50 px-8 py-5 border-b border-green-100 flex items-center gap-3">

                <i class="fa-solid fa-list text-brand"></i>

                <h3 class="text-lg font-semibold text-brand-dark">
                    Daftar Produk
                </h3>

            </div>

            <div class="overflow-x-auto p-4">

                <table class="w-full text-left border-collapse">

                    <thead>

                        <tr class="bg-gray-50 text-gray-600 font-medium text-sm uppercase tracking-wider border-b border-gray-200">

                            <th class="px-6 py-4 rounded-tl-xl text-center">ID</th>
                            <th class="px-6 py-4">Info Produk</th>
                            <th class="px-6 py-4">Harga</th>
                            <th class="px-6 py-4 text-center">Stok</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center rounded-tr-xl">Aksi</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($data as $row)

                        <tr class="hover:bg-green-50/30 transition duration-200 group">

                            <td class="px-6 py-4 text-center text-gray-500 font-medium">
                                #{{ $row->id_produk }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-4">

                                    @if($row->gambar)

                                    <img
                                        src="{{ asset('gambar_produk/'.$row->gambar) }}"
                                        class="w-14 h-14 object-cover rounded-xl shadow-sm border border-gray-100"
                                        alt="Produk">

                                    @else

                                    <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border border-gray-200">

                                        <i class="fa-solid fa-image"></i>

                                    </div>

                                    @endif

                                    <span class="font-semibold text-gray-800 text-base">
                                        {{ $row->nama_produk }}
                                    </span>

                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <span class="text-brand font-bold">
                                    Rp {{ number_format($row->harga,0,',','.') }}
                                </span>

                            </td>

                            <td class="px-6 py-4 text-center">

                                <span class="font-medium text-gray-700 bg-gray-100 px-3 py-1 rounded-lg">
                                    {{ $row->stok }}
                                </span>

                            </td>

                            <td class="px-6 py-4 text-center">

                                <span
                                    class="px-4 py-1.5 rounded-full text-xs font-bold border
                                    {{ $row->status_produk == 'Tersedia'
                                        ? 'bg-green-50 text-green-700 border-green-200'
                                        : 'bg-red-50 text-red-600 border-red-200' }}">

                                    {{ $row->status_produk }}

                                </span>
                                </td>

                            <td class="px-6 py-4 text-center">

    <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

        <!-- EDIT -->
        <a
            href="{{ url($routePrefix . '/produk/edit/'.$row->id_produk) }}"
            title="Edit"
            class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-500 hover:text-white transition-colors flex items-center justify-center shadow-sm">

            <i class="fa-solid fa-pen"></i>

        </a>

        <!-- HAPUS -->
        @if(session('role') == 'pemilik')
        <a
            href="{{ url('/owner/produk/hapus/'.$row->id_produk) }}"
            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
            title="Hapus"
            class="w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors flex items-center justify-center shadow-sm">

            <i class="fa-solid fa-trash-can"></i>

        </a>
        @endif

    </div>

</td>
                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">

                                <div class="text-gray-300 mb-3">
                                    <i class="fa-solid fa-box-open text-4xl"></i>
                                </div>

                                <p class="font-medium">
                                    Belum ada produk.
                                </p>

                                <p class="text-sm mt-1">
                                    Silakan tambahkan produk baru melalui formulir di atas.
                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <footer class="pb-8 text-center text-sm text-gray-500">

            &copy; {{ date('Y') }}
            PandCraft. Hak Cipta Dilindungi.

        </footer>

    </div>

</main>

                </div>
            

    <script>
    function toggleStok() {
        let status = document.getElementById("status_produk").value;
        let stok = document.getElementById("stok");

        if (status === "Tidak Tersedia") {
            stok.value = 0;
            stok.readOnly = true; // Mengunci input agar tidak bisa diisi
            stok.classList.add('bg-gray-100', 'text-gray-400');
        } else {
            stok.readOnly = false; // Membuka kunci input
            stok.classList.remove('bg-gray-100', 'text-gray-400');
        }
    }

    // Jalankan saat halaman dimuat untuk menyesuaikan status awal
    toggleStok();
    </script>

</body>
</html>