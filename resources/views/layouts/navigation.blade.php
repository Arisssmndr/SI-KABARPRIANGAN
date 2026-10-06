<!-- Sidebar Navigasi Kabar Priangan (Bersih, Terang, Tanpa Kotak Gelap / Teks Menu) -->
<aside class="w-64 bg-kp-blue-600 text-white flex flex-col shrink-0 min-h-screen border-r border-kp-blue-700/60 select-none">
    
    <!-- 1. Header Brand & Identitas Perusahaan -->
    <div class="px-5 py-4 border-b border-white/10 flex items-center gap-3 bg-kp-blue-700/40">
        <img src="{{ asset('images/kabarpriangan.png') }}" 
             alt="Logo Kabar Priangan" 
             class="h-9 w-9 object-contain rounded-full bg-white p-0.5 shadow-xs border border-white/20 shrink-0"
             onerror="this.src='{{ asset('logo.png') }}'">
        <div class="leading-tight min-w-0">
            <h1 class="font-extrabold text-sm tracking-wide text-white truncate">
                KABAR PRIANGAN
            </h1>
            <p class="text-[10px] font-medium text-kp-blue-100 tracking-wider uppercase">
                Sistem Kasir Iklan
            </p>
        </div>
    </div>

    <!-- 2. Navigasi Hirarkis (Tanpa Warna Gelap & Tanpa Kotak Teks Menu) -->
    <nav class="flex-1 px-3 py-4 space-y-4 overflow-y-auto">

        <!-- DASHBOARD UTAMA -->
        <div>
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-3.5 py-2.5 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white hover:bg-white/15 font-semibold' }}">
                <span>Dashboard Utama</span>
            </a>
        </div>

        <!-- 1. MASTER DATA (Khusus Administrator) -->
        @can('role=Administrator')
        <div class="border-t border-white/15 pt-3 space-y-1.5">
            <!-- Header Kategori Bersih -->
            <div class="px-3 py-1 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-300 shrink-0"></span>
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-white">
                    Master Data
                </span>
            </div>
            
            <!-- Daftar Sub Menu -->
            <div class="ml-3 pl-3 border-l border-white/25 space-y-1 py-0.5">
                <a href="{{ route('iklankoran.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('iklankoran.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Kategori Iklan Koran
                </a>

                <a href="{{ route('iklanonline.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('iklanonline.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Kategori Iklan Online
                </a>

                <a href="{{ route('iklanpriangan.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('iklanpriangan.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Kategori Priangan TV
                </a>
            </div>
        </div>
        @endcan

        <!-- 2. TRANSAKSI IKLAN -->
        <div class="border-t border-white/15 pt-3 space-y-1.5">
            <!-- Header Kategori Bersih -->
            <div class="px-3 py-1 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-300 shrink-0"></span>
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-white">
                    Transaksi Iklan
                </span>
            </div>

            <!-- Daftar Sub Menu -->
            <div class="ml-3 pl-3 border-l border-white/25 space-y-1 py-0.5">
                <a href="{{ route('transaksikoran.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('transaksikoran.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Iklan Koran Cetak
                </a>

                <a href="{{ route('transaksionline.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('transaksionline.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Iklan Online Portal
                </a>

                <a href="{{ route('transaksipriangan.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('transaksipriangan.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Iklan Priangan TV
                </a>
            </div>
        </div>

        <!-- 3. LAPORAN KEUANGAN -->
        <div class="border-t border-white/15 pt-3 space-y-1.5">
            <!-- Header Kategori Bersih -->
            <div class="px-3 py-1 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-300 shrink-0"></span>
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-white">
                    Laporan Keuangan
                </span>
            </div>

            <!-- Daftar Sub Menu -->
            <div class="ml-3 pl-3 border-l border-white/25 space-y-1 py-0.5">
                <a href="{{ route('laporankoran.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('laporankoran.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Laporan Iklan Koran
                </a>

                <a href="{{ route('laporanonline.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('laporanonline.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Laporan Iklan Online
                </a>

                <a href="{{ route('laporanpriangan.index') }}" 
                   class="block px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ request()->routeIs('laporanpriangan.*') ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    Laporan Priangan TV
                </a>
            </div>
        </div>

    </nav>
</aside>
