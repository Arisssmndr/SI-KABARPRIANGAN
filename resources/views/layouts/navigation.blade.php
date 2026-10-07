<!-- Sidebar Navigasi Kabar Priangan (Biru Resmi Kabar Priangan) -->
<aside class="w-64 bg-kp-blue-600 text-white flex flex-col shrink-0 h-full border-r border-kp-blue-700/60 select-none">

    <!-- 1. Header Brand & Identitas Perusahaan (Bulat Asli Sesuai Permintaan) -->
    <div class="px-5 py-4 border-b border-white/10 flex items-center gap-3 bg-kp-blue-700/40">
        <img src="{{ asset('images/kabarpriangan.png') }}" 
             alt="Logo Kabar Priangan" 
             class="h-9 w-9 object-contain rounded-full bg-white p-0.5 shadow-xs border border-white/20 shrink-0"
             onerror="this.src='{{ asset('logo.png') }}'">
        <div class="leading-tight min-w-0">
            <h1 class="font-extrabold text-sm tracking-wide text-white truncate">
                KABAR PRIANGAN
            </h1>
            <p class="text-[10px] font-medium text-kp-blue-100 tracking-wider uppercase mt-0.5">
                Sistem Kasir Iklan
            </p>
        </div>
    </div>

    <!-- 2. Navigasi Menu & Sub-Menu Simpel dengan Ikon -->
    <nav class="flex-1 px-3 py-3.5 space-y-3.5 overflow-y-auto">

        <!-- DASHBOARD UTAMA -->
        <div>
            @php $isDashboard = request()->routeIs('dashboard'); @endphp
            <a href="{{ route('dashboard') }}" 
               class="group flex items-center gap-2.5 px-3.5 py-2.5 text-xs rounded-lg transition-all duration-150 {{ $isDashboard ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white hover:bg-white/15 font-semibold' }}">
                <svg class="w-4 h-4 shrink-0 transition-colors {{ $isDashboard ? 'text-kp-blue-700' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="truncate">Dashboard</span>
            </a>
        </div>

        <!-- TRANSAKSI IKLAN -->
        <div class="border-t border-white/15 pt-3 space-y-1">
            <div class="px-3 pb-1 flex items-center justify-between">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-white">
                    Transaksi
                </span>
            </div>

            <div class="space-y-1">
                <!-- Koran Cetak -->
                @php $isKoranTx = request()->routeIs('transaksikoran.*'); @endphp
                <a href="{{ route('transaksikoran.index') }}" 
                   class="group flex items-center gap-2.5 px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ $isKoranTx ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0 transition-colors {{ $isKoranTx ? 'text-kp-blue-700' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                    <span class="truncate">Koran Cetak</span>
                </a>

                <!-- Media Online -->
                @php $isOnlineTx = request()->routeIs('transaksionline.*'); @endphp
                <a href="{{ route('transaksionline.index') }}" 
                   class="group flex items-center gap-2.5 px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ $isOnlineTx ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0 transition-colors {{ $isOnlineTx ? 'text-kp-blue-700' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253" />
                    </svg>
                    <span class="truncate">Media Online</span>
                </a>

                <!-- Priangan TV -->
                @php $isTvTx = request()->routeIs('transaksipriangan.*'); @endphp
                <a href="{{ route('transaksipriangan.index') }}" 
                   class="group flex items-center gap-2.5 px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ $isTvTx ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0 transition-colors {{ $isTvTx ? 'text-kp-blue-700' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v9.75c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <span class="truncate">Priangan TV</span>
                </a>
            </div>
        </div>

        <!-- LAPORAN KEUANGAN (1 Halaman Terpadu) -->
        <div class="border-t border-white/15 pt-3 space-y-1">
            <div class="px-3 pb-1 flex items-center justify-between">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-white">
                    Laporan
                </span>
            </div>

            <div class="space-y-1">
                @php $isLaporanActive = request()->routeIs('laporan.*') || request()->routeIs('laporankoran.*') || request()->routeIs('laporanonline.*') || request()->routeIs('laporanpriangan.*'); @endphp
                <a href="{{ route('laporan.index') }}" 
                   class="group flex items-center gap-2.5 px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ $isLaporanActive ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0 transition-colors {{ $isLaporanActive ? 'text-kp-blue-700' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span class="truncate">Laporan Keuangan</span>
                </a>
            </div>
        </div>

        <!-- MASTER DATA (Khusus Administrator) -->
        @can('role=Administrator')
        <div class="border-t border-white/15 pt-3 space-y-1">
            <div class="px-3 pb-1 flex items-center justify-between">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-white">
                    Master Data
                </span>
            </div>

            <div class="space-y-1">
                <!-- 1. Kategori Media -->
                @php $isKategoriMaster = request()->routeIs('kategori-media.*'); @endphp
                <a href="{{ route('kategori-media.index') }}" 
                   class="group flex items-center gap-2.5 px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ $isKategoriMaster ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0 transition-colors {{ $isKategoriMaster ? 'text-kp-blue-700' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    <span class="truncate">Kategori Media</span>
                </a>

                <!-- 2. Tipe & Jenis Iklan -->
                @php $isJenisMaster = request()->routeIs('jenis-iklan.*'); @endphp
                <a href="{{ route('jenis-iklan.index') }}" 
                   class="group flex items-center gap-2.5 px-3 py-2 text-xs rounded-lg transition-all duration-150 {{ $isJenisMaster ? 'bg-white text-kp-blue-700 font-bold shadow-xs' : 'text-white/90 hover:bg-white/15 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0 transition-colors {{ $isJenisMaster ? 'text-kp-blue-700' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    <span class="truncate">Tipe & Jenis Iklan</span>
                </a>
            </div>
        </div>
        @endcan

    </nav>
</aside>
