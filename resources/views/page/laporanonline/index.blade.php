<x-app-layout>
    <div class="max-w-3xl space-y-5">
        <!-- Header Halaman Langsung di Konten -->
        <div>
            <h1 class="text-xl font-bold text-black tracking-tight">
                Laporan Transaksi Iklan Online
            </h1>
            <p class="text-xs text-gray-600 mt-0.5">
                Cetak dan rekapitulasi pembukuan iklan portal digital Kabar Priangan
            </p>
        </div>

        <div class="bg-white border border-slate-300 rounded-xl shadow-xs overflow-hidden">
            <div class="p-5 bg-slate-50/90 border-b border-slate-200">
                <h2 class="text-sm font-bold text-slate-900">Parameter Rekapitulasi Laporan</h2>
                <p class="text-xs text-slate-500 mt-0.5 font-normal">Pilih rentang tanggal transaksi dan status pelunasan</p>
            </div>

            <form method="POST" action="{{ route('laporanonline.store') }}" target="_blank" class="p-5 sm:p-6 space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Dari Tanggal
                        </label>
                        <input type="date" 
                               name="dari" 
                               required 
                               value="{{ date('Y-m-01') }}" 
                               class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm text-black focus:outline-none focus:border-kp-blue-600 focus:ring-1 focus:ring-kp-blue-600 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Sampai Tanggal
                        </label>
                        <input type="date" 
                               name="sampai" 
                               required 
                               value="{{ date('Y-m-d') }}" 
                               class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm text-black focus:outline-none focus:border-kp-blue-600 focus:ring-1 focus:ring-kp-blue-600 transition" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Status Pembayaran
                    </label>
                    <select name="status" 
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm text-black focus:outline-none focus:border-kp-blue-600 focus:ring-1 focus:ring-kp-blue-600 transition">
                        <option value="all">Semua Status (Lunas & Belum Lunas)</option>
                        <option value="Lunas">Hanya yang Sudah Lunas</option>
                        <option value="Belum Lunas">Hanya yang Belum Lunas (Masih Ada Piutang)</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                    <button type="reset" 
                            class="px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-100 border border-slate-300 rounded-lg transition cursor-pointer">
                        Reset
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-kp-blue-600 hover:bg-kp-blue-700 active:bg-kp-blue-800 text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                        Cetak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
