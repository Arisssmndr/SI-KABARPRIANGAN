<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-kp-text tracking-tight">
                    Dashboard Kasir Iklan
                </h1>
                <p class="text-xs sm:text-sm text-kp-muted mt-1">
                    Ringkasan penerimaan, piutang, dan transaksi Harian Umum Kabar Priangan
                </p>
            </div>
            <!-- Tombol Aksi Cepat (10% Aksen Kuning/Amber) -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('transaksikoran.create') }}" 
                   class="px-4 py-2 bg-kp-accent hover:bg-kp-accent-hover active:bg-amber-800 text-white text-xs font-bold rounded-xl shadow-xs transition">
                    + Transaksi Koran
                </a>
                <a href="{{ route('transaksionline.create') }}" 
                   class="px-4 py-2 bg-kp-blue-600 hover:bg-kp-blue-700 text-white text-xs font-bold rounded-xl shadow-xs transition">
                    + Transaksi Online
                </a>
                <a href="{{ route('transaksipriangan.create') }}" 
                   class="px-4 py-2 bg-kp-blue-700 hover:bg-kp-blue-800 text-white text-xs font-bold rounded-xl shadow-xs transition">
                    + Transaksi TV
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        <!-- 1. Empat Kartu KPI Finansial Utama -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Omzet Bulan Ini -->
            <div class="bg-white border border-kp-border rounded-2xl p-5 shadow-xs">
                <span class="text-xs font-bold uppercase tracking-wider text-kp-muted block">
                    Omzet Bulan Ini
                </span>
                <p class="text-xl sm:text-2xl font-extrabold text-kp-blue-700 font-tabular mt-2">
                    Rp {{ number_format($totalOmzetBulanIni, 0, ',', '.') }}
                </p>
                <span class="text-[11px] text-kp-muted mt-1 block">
                    Total gabungan Koran, Online & TV
                </span>
            </div>

            <!-- Piutang Berjalan -->
            <div class="bg-white border border-kp-border rounded-2xl p-5 shadow-xs">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700 block">
                    Total Piutang Belum Lunas
                </span>
                <p class="text-xl sm:text-2xl font-extrabold text-red-600 font-tabular mt-2">
                    Rp {{ number_format($totalPiutang, 0, ',', '.') }}
                </p>
                <span class="text-[11px] text-kp-muted mt-1 block">
                    Tagihan kasir yang belum terbayar
                </span>
            </div>

            <!-- Total Faktur Terbit -->
            <div class="bg-white border border-kp-border rounded-2xl p-5 shadow-xs">
                <span class="text-xs font-bold uppercase tracking-wider text-kp-muted block">
                    Total Semua Transaksi
                </span>
                <p class="text-xl sm:text-2xl font-extrabold text-kp-text font-tabular mt-2">
                    {{ number_format($totalTransaksi, 0, ',', '.') }} <span class="text-sm font-semibold text-kp-muted">Faktur</span>
                </p>
                <span class="text-[11px] text-kp-muted mt-1 block">
                    Keseluruhan transaksi tercatat
                </span>
            </div>

            <!-- Transaksi Hari Ini -->
            <div class="bg-white border border-kp-border rounded-2xl p-5 shadow-xs">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 block">
                    Transaksi Hari Ini
                </span>
                <p class="text-xl sm:text-2xl font-extrabold text-emerald-600 font-tabular mt-2">
                    {{ $totalHariIni }} <span class="text-sm font-semibold text-kp-muted">Faktur Baru</span>
                </p>
                <span class="text-[11px] text-kp-muted mt-1 block">
                    Aktivitas kasir per hari ini
                </span>
            </div>
        </div>

        <!-- 2. Ringkasan Penerimaan per Media -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Iklan Koran -->
            <div class="bg-white border border-kp-border rounded-2xl p-5 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-kp-border">
                    <h2 class="text-sm font-bold text-kp-text">Iklan Koran Cetak</h2>
                    <span class="text-xs px-2.5 py-0.5 rounded-full bg-kp-blue-50 text-kp-blue-700 font-bold border border-kp-blue-200">
                        {{ $countKoran }} Faktur
                    </span>
                </div>
                <div class="mt-4 space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-kp-muted">Omzet Bulan Ini:</span>
                        <span class="font-bold text-kp-text font-tabular">Rp {{ number_format($omzetKoran, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-kp-border">
                    <a href="{{ route('transaksikoran.index') }}" 
                       class="text-xs font-bold text-kp-blue-600 hover:text-kp-blue-800 transition block text-right">
                        Kelola Iklan Koran &rarr;
                    </a>
                </div>
            </div>

            <!-- Iklan Online -->
            <div class="bg-white border border-kp-border rounded-2xl p-5 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-kp-border">
                    <h2 class="text-sm font-bold text-kp-text">Iklan Online Portal</h2>
                    <span class="text-xs px-2.5 py-0.5 rounded-full bg-kp-blue-50 text-kp-blue-700 font-bold border border-kp-blue-200">
                        {{ $countOnline }} Faktur
                    </span>
                </div>
                <div class="mt-4 space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-kp-muted">Omzet Bulan Ini:</span>
                        <span class="font-bold text-kp-text font-tabular">Rp {{ number_format($omzetOnline, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-kp-border">
                    <a href="{{ route('transaksionline.index') }}" 
                       class="text-xs font-bold text-kp-blue-600 hover:text-kp-blue-800 transition block text-right">
                        Kelola Iklan Online &rarr;
                    </a>
                </div>
            </div>

            <!-- Iklan Priangan TV -->
            <div class="bg-white border border-kp-border rounded-2xl p-5 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-kp-border">
                    <h2 class="text-sm font-bold text-kp-text">Iklan Priangan TV</h2>
                    <span class="text-xs px-2.5 py-0.5 rounded-full bg-kp-blue-50 text-kp-blue-700 font-bold border border-kp-blue-200">
                        {{ $countTv }} Faktur
                    </span>
                </div>
                <div class="mt-4 space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-kp-muted">Omzet Bulan Ini:</span>
                        <span class="font-bold text-kp-text font-tabular">Rp {{ number_format($omzetTv, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-kp-border">
                    <a href="{{ route('transaksipriangan.index') }}" 
                       class="text-xs font-bold text-kp-blue-600 hover:text-kp-blue-800 transition block text-right">
                        Kelola Iklan TV &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- 3. Tabel Transaksi Koran Terbaru -->
        <div class="bg-white border border-kp-border rounded-2xl p-6 shadow-xs">
            <div class="flex items-center justify-between pb-4 border-b border-kp-border mb-4">
                <div>
                    <h2 class="text-base font-bold text-kp-text">
                        Aktivitas Transaksi Iklan Terbaru
                    </h2>
                    <p class="text-xs text-kp-muted mt-0.5">
                        Daftar faktur pemesanan iklan yang baru dicatat di sistem
                    </p>
                </div>
                <a href="{{ route('transaksikoran.index') }}" 
                   class="text-xs font-bold text-kp-blue-600 hover:underline">
                    Lihat Semua Koran &rarr;
                </a>
            </div>

            @if($recentKoran->isEmpty() && $recentOnline->isEmpty() && $recentTv->isEmpty())
                <div class="py-12 text-center text-kp-muted">
                    <p class="text-sm font-medium">Belum ada transaksi iklan yang tersimpan di sistem.</p>
                    <p class="text-xs mt-1">Klik salah satu tombol "+ Transaksi" di atas untuk mulai mencatat transaksi pertama.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-kp-border text-kp-muted uppercase tracking-wider text-[11px]">
                                <th class="py-3 px-4 font-bold">Media</th>
                                <th class="py-3 px-4 font-bold">No Faktur</th>
                                <th class="py-3 px-4 font-bold">Tanggal</th>
                                <th class="py-3 px-4 font-bold">Pemasang</th>
                                <th class="py-3 px-4 font-bold">Jenis Iklan</th>
                                <th class="py-3 px-4 font-bold text-right">Tagihan</th>
                                <th class="py-3 px-4 font-bold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-kp-border">
                            @foreach($recentKoran as $k)
                                <tr class="hover:bg-kp-canvas/60 transition">
                                    <td class="py-3 px-4 font-semibold text-kp-blue-700">Koran</td>
                                    <td class="py-3 px-4 font-bold text-kp-text">{{ $k->nofakturkoran }}</td>
                                    <td class="py-3 px-4 text-kp-muted">{{ $k->tanggal_transaksikoran }}</td>
                                    <td class="py-3 px-4 font-semibold text-kp-text">{{ $k->nama_pemasangkoran }}</td>
                                    <td class="py-3 px-4 text-kp-muted">{{ $k->iklankoran->jenis_iklankoran ?? '-' }}</td>
                                    <td class="py-3 px-4 text-right font-bold text-kp-text font-tabular">
                                        Rp {{ number_format($k->totaltagihan_transaksikoran, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($k->piutang_transaksikoran <= 0)
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Lunas
                                            </span>
                                        @else
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                                Belum Lunas
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @foreach($recentOnline as $o)
                                <tr class="hover:bg-kp-canvas/60 transition">
                                    <td class="py-3 px-4 font-semibold text-sky-700">Online</td>
                                    <td class="py-3 px-4 font-bold text-kp-text">{{ $o->nofakturonline }}</td>
                                    <td class="py-3 px-4 text-kp-muted">{{ $o->tanggal_transaksionline }}</td>
                                    <td class="py-3 px-4 font-semibold text-kp-text">{{ $o->nama_pemasangonline }}</td>
                                    <td class="py-3 px-4 text-kp-muted">{{ $o->iklanonline->jenis_iklanonline ?? '-' }}</td>
                                    <td class="py-3 px-4 text-right font-bold text-kp-text font-tabular">
                                        Rp {{ number_format($o->totaltagihan_transaksionline, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($o->piutang_transaksionline <= 0)
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Lunas
                                            </span>
                                        @else
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                                Belum Lunas
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @foreach($recentTv as $tv)
                                <tr class="hover:bg-kp-canvas/60 transition">
                                    <td class="py-3 px-4 font-semibold text-indigo-700">Priangan TV</td>
                                    <td class="py-3 px-4 font-bold text-kp-text">{{ $tv->nofakturpriangan }}</td>
                                    <td class="py-3 px-4 text-kp-muted">{{ $tv->tanggal_transaksipriangan }}</td>
                                    <td class="py-3 px-4 font-semibold text-kp-text">{{ $tv->nama_pemasangpriangan }}</td>
                                    <td class="py-3 px-4 text-kp-muted">{{ $tv->iklanpriangan->jenis_iklanpriangan ?? '-' }}</td>
                                    <td class="py-3 px-4 text-right font-bold text-kp-text font-tabular">
                                        Rp {{ number_format($tv->harga_transaksipriangan, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($tv->piutang_transaksipriangan <= 0)
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Lunas
                                            </span>
                                        @else
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                                Belum Lunas
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
