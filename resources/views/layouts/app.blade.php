<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIKAPRI - Kasir Iklan Kabar Priangan') }}</title>
    <link rel="icon" href="{{ asset('kabarpriangan.png') }}" type="image/png">

    <!-- Fonts: Plus Jakarta Sans (Standar Media Cetak Modern) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Select2 Stylesheet (Minimal) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery & Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .select2-container .select2-selection--single {
            width: 100% !important;
            background-color: #ffffff;
            border: 1px solid #cbd5e1 !important;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            height: 42px;
            border-radius: 0.75rem;
            color: #111827;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            top: 20% !important;
            right: 10px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            font-size: 14px !important;
            top: -2px;
            left: -4px;
            position: relative;
            color: #111827;
        }

        .select2-search__field {
            font-size: 14px !important;
            border-radius: 0.5rem;
            border: 1px solid #cbd5e1;
        }

        .select2-results {
            font-size: 14px !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-100 text-slate-900 selection:bg-kp-blue-100 selection:text-kp-blue-900">
    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen flex bg-slate-100">

        <!-- 1. Desktop Sidebar Navigation (Fixed on Left, 60% Blue Kabar Priangan) -->
        <div class="hidden md:flex md:w-64 md:shrink-0 sticky top-0 h-screen z-40">
            @include('layouts.navigation')
        </div>

        <!-- 2. Mobile Drawer Navigation (Slide-over on Mobile) -->
        <div x-cloak x-show="mobileMenuOpen" class="relative z-50 md:hidden" role="dialog" aria-modal="true">
            <!-- Backdrop -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-200"
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0"
                 @click="mobileMenuOpen = false" 
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs"></div>

            <div class="fixed inset-0 flex">
                <div x-show="mobileMenuOpen" 
                     x-transition:enter="transition ease-in-out duration-200 transform"
                     x-transition:enter-start="-translate-x-full" 
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-200 transform"
                     x-transition:leave-start="translate-x-0" 
                     x-transition:leave-end="-translate-x-full"
                     class="relative mr-16 flex w-full max-w-xs flex-1">
                    @include('layouts.navigation')
                </div>
            </div>
        </div>

        <!-- 3. Right Column: Topbar + Main Content + Footer -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">
            <!-- Topbar Bersih (Putih 30%) -->
            <header class="bg-white border-b border-slate-200 px-4 sm:px-6 py-3 flex items-center justify-between sticky top-0 z-30 shadow-xs">
                <div class="flex items-center gap-3">
                    <!-- Tombol Buka Menu di HP -->
                    <button type="button" 
                            @click="mobileMenuOpen = true"
                            class="md:hidden px-3 py-1.5 rounded-lg border border-slate-300 text-slate-800 hover:bg-slate-50 font-semibold text-xs transition">
                        Menu
                    </button>
                    <!-- Indikator Portal & Tanggal -->
                    <div class="hidden sm:flex items-center text-xs text-slate-500 font-medium">
                        <span class="font-bold text-kp-blue-700">Harian Umum Kabar Priangan</span>
                        <span class="mx-2 text-slate-300">/</span>
                        <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>

                <!-- Profil Kasir / User di Kanan Atas Header (Standar Web Modern) -->
                <div x-data="{ userMenuOpen: false }" class="relative">
                    <button @click="userMenuOpen = !userMenuOpen" 
                            @click.outside="userMenuOpen = false"
                            type="button" 
                            class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg border border-slate-300 hover:bg-slate-50 transition text-left cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-kp-blue-600 text-white font-semibold text-xs flex items-center justify-center shrink-0 shadow-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden sm:block leading-tight">
                            <div class="text-xs font-semibold text-black leading-tight">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-[10px] text-gray-500 font-normal">
                                {{ Auth::user()->role ?? 'Kasir' }}
                            </div>
                        </div>
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="userMenuOpen" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-1.5 z-50 divide-y divide-slate-100"
                         style="display: none;">
                        
                        <div class="px-3.5 py-2">
                            <p class="text-xs font-semibold text-black">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            <span class="inline-block mt-1 px-1.5 py-0.5 text-[9px] font-medium uppercase rounded bg-kp-blue-50 text-kp-blue-700 border border-kp-blue-200">
                                {{ Auth::user()->role ?? 'Kasir' }}
                            </span>
                        </div>

                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center px-3.5 py-2 text-xs text-gray-800 hover:bg-slate-50 hover:text-kp-blue-600 transition font-medium">
                                Profil Saya
                            </a>
                        </div>

                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="w-full text-left px-3.5 py-2 text-xs text-rose-600 hover:bg-rose-50 transition font-medium cursor-pointer">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Main Content Slot -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer Bersih -->
            <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-xs text-slate-600 font-normal">
                &copy; {{ date('Y') }} <span class="font-semibold text-slate-900">Harian Umum Kabar Priangan</span> — Sistem Informasi Kasir Iklan (SIKAPRI)
            </footer>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($(".js-example-placeholder-single").length > 0) {
                $(".js-example-placeholder-single").select2({
                    placeholder: "Pilih...",
                    allowClear: true,
                    width: '100%'
                });
            }
        });
    </script>
    @stack('scripts')

    <!-- SweetAlert Notifikasi -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                timerProgressBar: true,
                confirmButtonColor: '#0A72AC',
                showConfirmButton: false,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '{{ session('error') }}',
                timer: 3000,
                timerProgressBar: true,
                confirmButtonColor: '#0A72AC',
                showConfirmButton: false,
            });
        @endif
    </script>
</body>

</html>
