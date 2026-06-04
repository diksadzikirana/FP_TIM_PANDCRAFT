<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pemilik - PandCraft</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap"
          rel="stylesheet">

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

<body class="font-sans bg-brand-light bg-[url('/images/ok.jpeg')] bg-cover bg-center bg-no-repeat min-h-screen flex flex-col items-center justify-center text-gray-800 p-6">

<div class="bg-white p-10 md:p-12 w-full max-w-md rounded-3xl shadow-xl border border-green-50 relative overflow-hidden">

    <div class="absolute -top-10 -right-10 w-32 h-32 bg-green-50 rounded-full blur-2xl opacity-70"></div>

    <div class="text-center mb-10 relative z-10">

        <div class="text-4xl font-serif font-bold text-brand-dark mb-2">
            PandCraft<span class="text-brand">.</span>
        </div>

        <h2 class="text-gray-500 font-medium">
            Portal Akses
            <span class="text-brand font-semibold">Pemilik</span>
        </h2>

    </div>

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/owner/login" class="relative z-10 space-y-5">

        @csrf

        <div>

            <label for="nama"
                   class="block text-sm font-medium text-gray-700 mb-2">
                Nama Pengguna
            </label>

            <div class="relative">

                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-regular fa-user"></i>
                </div>

               <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama', request()->cookie('remember_user')) }}"
                    placeholder="Masukkan nama Anda"
    
                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand focus:border-brand outline-none transition bg-gray-50 focus:bg-white text-gray-700"
                >
            </div>
                    @error('nama')
                    <div class="mt-2 text-sm text-red-600">
                     {{ $message }}
                    </div>
                    @enderror
        </div>

        <div>

            <label for="password"
                   class="block text-sm font-medium text-gray-700 mb-2">
                Kata Sandi
            </label>

            <div class="relative">

                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <input
                     type="password"
                     id="password"
                     name="password"
                     placeholder="Masukkan kata sandi"
                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand focus:border-brand outline-none transition bg-gray-50 focus:bg-white text-gray-700"
                >
                    
            </div>
                @error('password')
                    <div class="mt-2 text-sm text-red-600">
                     {{ $message }}
                    </div>
                    @enderror
        </div>

        <div class="flex items-center">

            <input
                type="checkbox"
                id="remember"
                name="remember"
                class="w-4 h-4 text-brand bg-gray-100 border-gray-300 rounded focus:ring-brand focus:ring-2 accent-brand cursor-pointer"
            >

            <label for="remember"
                   class="ml-2 text-sm font-medium text-gray-600 cursor-pointer">
                Ingat Saya (Remember Me)
            </label>

        </div>

        <button
            type="submit"
            class="w-full py-3.5 mt-4 bg-brand text-white font-medium rounded-xl hover:bg-brand-dark transition shadow-lg shadow-green-200"
        >
            Masuk ke Dashboard
        </button>

    </form>

    <div class="mt-8 text-center relative z-10">

        <a href="/"
           class="text-sm font-medium text-gray-500 hover:text-brand transition flex items-center justify-center gap-2">

            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Beranda

        </a>

    </div>

</div>

</body>
</html>