<!-- Sidebar Navigasi Kabar Priangan (60% Warna Brand Biru, Bebas Icon, Bersih & Modern) -->
<aside class="w-64 bg-kp-blue-600 text-white flex flex-col shrink-0 min-h-screen border-r border-kp-blue-700 select-none">
    <!-- Header Logo & Identitas Perusahaan -->
    <div class="p-5 border-b border-kp-blue-700/60 flex items-center gap-3 bg-kp-blue-700/30">
        <img src="{{ asset('images/kabarpriangan.png') }}" 
             alt="Logo Kabar Priangan" 
             class="h-10 w-10 object-contain rounded-full bg-white p-0.5 shadow-sm"
             onerror="this.src='{{ asset('logo.png') }}'">
        <div class="leading-tight">
            <h1 class="font-extrabold text-base tracking-wide text-white">
                KABAR PRIANGAN
            </h1>
            <p class="text-[11px] font-medium text-kp-blue-100 tracking-wider uppercase">
                Sistem Kasir Iklan
            </p>
        </div>
    </div>

    <!-- Menu Links Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-6 overflow-y-auto">
        <!-- Section: Menu Utama -->
        <div>
            <p class="px-3 mb-2 text-[10px] font-bold text-kp-blue-200 uppercase tracking-widest">
                Menu Utama
            </p>
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('dashboard') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Dashboard
                </a>
            </div>
        </div>

        <!-- Section: Transaksi Iklan -->
        <div>
            <p class="px-3 mb-2 text-[10px] font-bold text-kp-blue-200 uppercase tracking-widest">
                Transaksi Iklan
            </p>
            <div class="space-y-1">
                <a href="{{ route('transaksikoran.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('transaksikoran.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Iklan Koran
                </a>
                <a href="{{ route('transaksionline.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('transaksionline.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Iklan Online
                </a>
                <a href="{{ route('transaksipriangan.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('transaksipriangan.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Iklan Priangan TV
                </a>
            </div>
        </div>

        <!-- Section: Laporan Keuangan -->
        <div>
            <p class="px-3 mb-2 text-[10px] font-bold text-kp-blue-200 uppercase tracking-widest">
                Laporan Keuangan
            </p>
            <div class="space-y-1">
                <a href="{{ route('laporankoran.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('laporankoran.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Laporan Koran
                </a>
                <a href="{{ route('laporanonline.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('laporanonline.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Laporan Online
                </a>
                <a href="{{ route('laporanpriangan.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('laporanpriangan.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Laporan Priangan TV
                </a>
            </div>
        </div>

        <!-- Section: Master Data Iklan -->
        @can('role=Administrator')
        <div>
            <p class="px-3 mb-2 text-[10px] font-bold text-kp-blue-200 uppercase tracking-widest">
                Master Data Iklan
            </p>
            <div class="space-y-1">
                <a href="{{ route('iklankoran.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('iklankoran.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Data Iklan Koran
                </a>
                <a href="{{ route('iklanonline.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('iklanonline.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Data Iklan Online
                </a>
                <a href="{{ route('iklanpriangan.index') }}" 
                   class="flex items-center px-3 py-2 text-sm font-semibold rounded-xl transition duration-150 {{ request()->routeIs('iklanpriangan.*') ? 'bg-white text-kp-blue-700 shadow-sm' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-2 font-bold">•</span> Data Iklan Priangan TV
                </a>
            </div>
        </div>
        @endcan
    </nav>

    <!-- User Profile & Action Bar di Bagian Bawah Sidebar -->
    <div class="p-4 border-t border-kp-blue-700/60 bg-kp-blue-700/40">
        <div class="flex items-center justify-between mb-3">
            <div>
                <p class="text-sm font-bold text-white truncate max-w-[150px]">
                    {{ Auth::user()->name }}
                </p>
                <span class="inline-block mt-0.5 px-2 py-0.5 text-[10px] font-semibold bg-white/20 text-white rounded">
                    {{ Auth::user()->role ?? 'Kasir' }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2 pt-2 border-t border-white/10 text-xs">
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 text-center py-1.5 px-2 rounded-lg bg-white/10 hover:bg-white/20 text-white font-medium transition">
                Profil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full text-center py-1.5 px-2 rounded-lg bg-red-500/80 hover:bg-red-600 text-white font-semibold transition">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</aside>
