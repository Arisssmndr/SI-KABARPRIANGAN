<!-- Sidebar Navigasi Kabar Priangan (Modern, Non-Redundant, Direct Dropdown) -->
<aside class="w-64 bg-kp-blue-600 text-white flex flex-col shrink-0 min-h-screen border-r border-kp-blue-700 select-none">
    
    <!-- 1. Header Brand & Identitas Perusahaan (Logo Bulat Sesuai Foto 2) -->
    <div class="p-4 border-b border-white/10 flex items-center gap-3 bg-kp-blue-700/40">
        <img src="{{ asset('images/kabarpriangan.png') }}" 
             alt="Logo Kabar Priangan" 
             class="h-10 w-10 object-contain rounded-full bg-white p-0.5 shadow-sm border border-white/20 shrink-0"
             onerror="this.src='{{ asset('logo.png') }}'">
        <div class="leading-tight min-w-0">
            <h1 class="font-extrabold text-sm tracking-wide text-white truncate">
                KABAR PRIANGAN
            </h1>
            <p class="text-[10px] font-semibold text-kp-blue-100 tracking-wider uppercase">
                Sistem Kasir Iklan
            </p>
        </div>
    </div>

    <!-- 2. Menu Navigasi Bersih & Langsung (Tanpa Judul Kategori Redundan) -->
    <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto">

        <!-- 1. DASHBOARD -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center justify-between px-3.5 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
            <span>Dashboard</span>
        </a>

        <!-- 2. DROPDOWN MASTER DATA (Khusus Administrator) -->
        @can('role=Administrator')
        <div x-data="{ open: {{ request()->routeIs('iklankoran.*', 'iklanonline.*', 'iklanpriangan.*') ? 'true' : 'false' }} }" class="space-y-1">
            <button type="button" 
                    @click="open = !open" 
                    class="w-full flex items-center justify-between px-3.5 py-2.5 text-sm font-semibold rounded-lg transition duration-150 {{ request()->routeIs('iklankoran.*', 'iklanonline.*', 'iklanpriangan.*') ? 'bg-white/15 text-white' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                <span>Master Data</span>
                <svg class="w-4 h-4 transform transition-transform duration-200 text-white/70" 
                     :class="open ? 'rotate-180 text-white' : ''" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Submenu dengan Garis Pemandu Tipis -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="pl-3 py-1 space-y-1 border-l border-white/20 ml-4 my-1">
                
                <a href="{{ route('iklankoran.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('iklankoran.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Kategori Iklan Koran
                </a>

                <a href="{{ route('iklanonline.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('iklanonline.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Kategori Iklan Online
                </a>

                <a href="{{ route('iklanpriangan.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('iklanpriangan.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Kategori Priangan TV
                </a>
            </div>
        </div>
        @endcan

        <!-- 3. DROPDOWN TRANSAKSI IKLAN -->
        <div x-data="{ open: {{ request()->routeIs('transaksikoran.*', 'transaksionline.*', 'transaksipriangan.*') ? 'true' : 'false' }} }" class="space-y-1">
            <button type="button" 
                    @click="open = !open" 
                    class="w-full flex items-center justify-between px-3.5 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ request()->routeIs('transaksikoran.*', 'transaksionline.*', 'transaksipriangan.*') ? 'bg-white/15 text-white' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                <span>Transaksi Iklan</span>
                <svg class="w-4 h-4 transform transition-transform duration-200 text-white/70" 
                     :class="open ? 'rotate-180 text-white' : ''" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Submenu dengan Garis Pemandu Tipis -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="pl-3 py-1 space-y-1 border-l border-white/20 ml-4 my-1">
                
                <a href="{{ route('transaksikoran.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('transaksikoran.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Iklan Koran Cetak
                </a>

                <a href="{{ route('transaksionline.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('transaksionline.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Iklan Online Portal
                </a>

                <a href="{{ route('transaksipriangan.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('transaksipriangan.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Iklan Priangan TV
                </a>
            </div>
        </div>

        <!-- 4. DROPDOWN LAPORAN KEUANGAN (Paling Akhir) -->
        <div x-data="{ open: {{ request()->routeIs('laporankoran.*', 'laporanonline.*', 'laporanpriangan.*') ? 'true' : 'false' }} }" class="space-y-1">
            <button type="button" 
                    @click="open = !open" 
                    class="w-full flex items-center justify-between px-3.5 py-2.5 text-sm font-semibold rounded-lg transition duration-150 {{ request()->routeIs('laporankoran.*', 'laporanonline.*', 'laporanpriangan.*') ? 'bg-white/15 text-white' : 'text-white/85 hover:bg-white/10 hover:text-white' }}">
                <span>Laporan Keuangan</span>
                <svg class="w-4 h-4 transform transition-transform duration-200 text-white/70" 
                     :class="open ? 'rotate-180 text-white' : ''" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Submenu dengan Garis Pemandu Tipis -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="pl-3 py-1 space-y-1 border-l border-white/20 ml-4 my-1">
                
                <a href="{{ route('laporankoran.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('laporankoran.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Laporan Iklan Koran
                </a>

                <a href="{{ route('laporanonline.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('laporanonline.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Laporan Iklan Online
                </a>

                <a href="{{ route('laporanpriangan.index') }}" 
                   class="block px-3 py-2 text-xs font-semibold rounded-md transition duration-150 {{ request()->routeIs('laporanpriangan.*') ? 'bg-white text-kp-blue-700 shadow-xs' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Laporan Priangan TV
                </a>
            </div>
        </div>

    </nav>
</aside>
