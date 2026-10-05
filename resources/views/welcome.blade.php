<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kabar Priangan Ad Cashier</title>
    <link rel="icon" href="{{ asset('kabarpriangan.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Fallback CSS jika Vite belum build */
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-sans">

    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main
            class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row shadow-2xl rounded-2xl overflow-hidden bg-white dark:bg-[#161615]">

            <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-16 flex flex-col justify-center">

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white tracking-tight">Kabar Priangan</h2>
                    <span class="text-xs font-bold tracking-widest text-blue-600 dark:text-blue-400 uppercase">Aplikasi
                        Kasir Iklan</span>
                </div>

                <h1 class="mb-4 text-4xl font-semibold text-gray-900 dark:text-white leading-tight">
                    Selamat Datang <br>
                    <span class="text-blue-600 dark:text-blue-500">Portal Transaksi</span>
                </h1>

                <p class="mb-8 text-gray-500 dark:text-gray-400 text-base leading-relaxed">
                    Kelola transaksi iklan, cetak faktur, dan pantau laporan keuangan Kabar Priangan dalam satu sistem
                    yang terintegrasi.
                </p>

                <div class="flex flex-col gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="w-fit px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                            Buka Dashboard &rarr;
                        </a>
                    @else
                        <div class="flex gap-4 items-center">
                            <a href="{{ route('login') }}"
                                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg hover:shadow-blue-500/30 transition-all">
                                Login
                            </a>
                        </div>
                    @endauth
                </div>

                <p class="mt-12 text-xs text-gray-400 border-t pt-4 dark:border-gray-800">
                    &copy; {{ date('Y') }} Kabar Priangan. All rights reserved.
                </p>
            </div>

            <div class="relative lg:w-[500px] shrink-0 overflow-hidden hidden lg:block">
                <img src="{{ asset('images/text.jpg') }}" alt="Dashboard Preview"
                    class="w-full h-full object-cover object-center opacity-95 hover:scale-105 transition-transform duration-700 ease-in-out"
                    onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'" />

                <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent dark:from-[#161615]/40">
                </div>
                <div class="absolute inset-0 bg-blue-600/10 mix-blend-multiply"></div>
            </div>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
