<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TRANSAKSI IKLAN PRIANGAN TV') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form class="space-y-6" method="POST" action="{{ route('transaksipriangan.store') }}">
                @csrf
                {{-- BAGIAN 1: INFO UTAMA --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="border-b pb-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white uppercase">Form Input Transaksi Priangan TV
                        </h3>
                        <p class="text-sm text-gray-500">Silakan isi data transaksi dengan lengkap dan benar.</p>
                    </div>

                    @if ($errors->any())
                        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200"
                            role="alert">
                            <strong class="font-bold block mb-1">Terjadi Kesalahan!</strong>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">No
                                    Faktur</label>
                                <input type="text" name="nofakturpriangan"
                                    value="{{ $nofakturpriangan ?? 'TRX-PRG-001' }}" readonly
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama
                                    Pemasang</label>
                                <input type="text" name="nama_pemasangpriangan" required placeholder="Nama Pemasang"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama
                                    Sales</label>
                                <input type="text" name="sales_iklanpriangan" required placeholder="Nama Sales"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                    Transaksi</label>
                                <input type="date" name="tanggal_transaksipriangan" required
                                    value="{{ date('Y-m-d') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Alamat
                                    Pemasang</label>
                                <textarea name="alamat_pemasangpriangan" rows="5" required placeholder="Alamat lengkap..."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 2: JENIS IKLAN --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jenis
                                Iklan</label>
                            <select name="id_iklanpriangan" id="id_iklanpriangan" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" disabled {{ old('id_iklanpriangan') == '' ? 'selected' : '' }}>Pilih Jenis Iklan...</option>
                                @foreach($iklanpriangan as $ip)
                                   <option value="{{ $ip->id }}" {{ old('id_iklanpriangan') == $ip->id ? 'selected' : '' }}>
                                    {{ $ip->jenis_iklanpriangan ?? $ip->nama_iklanpriangan ?? 'Kolom Salah/Kosong' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                Muat</label>
                            <input type="date" name="tanggal_muatiklanpriangan" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 3: INPUT PEMBAYARAN --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <h4 class="font-bold text-blue-800 mb-4">Rincian Pembayaran</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Harga
                                    (Manual)</label>
                                <input type="text" id="harga_transaksipriangan" name="harga_transaksipriangan"
                                    required onkeyup="formatInput(this)"
                                    class="bg-white border border-blue-500 text-gray-900 text-lg font-bold rounded-lg block w-full p-2.5"
                                    placeholder="Input Harga..." />
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Diskon
                                    (Rp)</label>
                                <input type="text" id="diskon_transaksipriangan" name="diskon_transaksipriangan"
                                    value="0" required onkeyup="formatInput(this)"
                                    class="bg-white border border-blue-500 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jumlah
                                    Dibayar (DP)</label>
                                <input type="text" id="jumlahbayar_transaksipriangan"
                                    name="jumlahbayar_transaksipriangan" value="0" required
                                    onkeyup="formatInput(this)"
                                    class="bg-white border border-green-500 text-gray-900 text-lg font-bold rounded-lg block w-full p-2.5" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 4: RINCIAN KALKULASI & TOTAL --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- DPP (Display Only) --}}
                        <div>
                            <label class="block mb-1 font-medium text-gray-500">DPP (Nilai / 1.11)</label>
                            <input type="text" id="dpp_transaksipriangan" name="dpp_transaksipriangan" readonly value="0"
                                class="bg-gray-100 border border-gray-200 text-gray-700 text-sm rounded block w-full p-2" />
                        </div>

                        {{-- PPN --}}
                        <div>
                            <label class="block mb-1 font-medium text-gray-500">PPN (11%)</label>
                            <input type="text" id="ppn_transaksipriangan" name="ppn_transaksipriangan" readonly
                                value="0"
                                class="bg-gray-100 border border-gray-200 text-gray-700 text-sm rounded block w-full p-2" />
                        </div>

                        {{-- Komisi (Manual Rupiah) --}}
                        <div>
                            <label class="block mb-1 font-medium text-gray-500">Komisi (Rp)</label>
                            <input type="text"
                                id="komisi_transaksipriangan"
                                name="komisi_transaksipriangan"
                                value="0"
                                inputmode="numeric"
                                class="border border-gray-300 text-gray-700 text-sm rounded block w-full p-2" />
                        </div>

                        {{-- Insentif (Manual Rupiah) --}}
                        <div>
                            <label class="block mb-1 font-medium text-gray-500">Insentif (Rp)</label>
                            <input type="text"
                                id="insentif_transaksipriangan"
                                name="insentif_transaksipriangan"
                                value="0"
                                inputmode="numeric"
                                class="border border-gray-300 text-gray-700 text-sm rounded block w-full p-2" />
                        </div>

                        {{-- TOTAL TAGIHAN --}}
                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">TOTAL
                                TAGIHAN</label>
                            <input type="text" id="totaltagihan_transaksipriangan"
                                name="totaltagihan_transaksipriangan" readonly value="0"
                                class="bg-gray-800 border border-gray-300 text-white text-sm rounded-lg block w-full p-2.5" />
                        </div>

                        {{-- SISA PIUTANG --}}
                        <div>
                            <label class="block mb-2 text-sm font-bold text-red-600 dark:text-white">SISA
                                PIUTANG</label>
                            <input type="text" id="piutang_transaksipriangan" name="piutang_transaksipriangan"
                                readonly value="0"
                                class="bg-red-100 text-red-600 border border-red-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                        <a href="{{ route('transaksipriangan.index') }}"
                            class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-8 py-2.5 text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center shadow-lg">
                            Simpan Transaksi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function formatRupiah(angka) {
            if (!angka) return '0';
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function cleanNumber(rupiah) {
            if (!rupiah) return 0;
            return parseFloat(rupiah.toString().replace(/[^0-9]/g, '')) || 0;
        }

        function formatInput(input) {
            let val = cleanNumber(input.value);
            input.value = formatRupiah(val);
            hitungSemua();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // INPUTS
            const selectJenis = document.getElementById('id_iklanpriangan');
            const inputHarga = document.getElementById('harga_transaksipriangan');
            const inputDiskon = document.getElementById('diskon_transaksipriangan');
            const inputBayar = document.getElementById('jumlahbayar_transaksipriangan');

            // OUTPUTS
            const inputDPP = document.getElementById('dpp_transaksipriangan'); // Baru
            const inputPPN = document.getElementById('ppn_transaksipriangan');
            const inputKomisi = document.getElementById('komisi_transaksipriangan'); // Baru
            const inputInsentif = document.getElementById('insentif_transaksipriangan'); // Baru
            const inputTotal = document.getElementById('totaltagihan_transaksipriangan');
            const inputPiutang = document.getElementById('piutang_transaksipriangan');

            // Autofill Harga dari Jenis Iklan
            selectJenis.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const hargaDb = parseFloat(selectedOption.dataset.harga) || 0;

                inputHarga.value = formatRupiah(hargaDb);
                hitungSemua();
            });

            // =========================================================
        // PERHITUNGAN TRANSAKSI PRIANGAN
        // =========================================================
        window.hitungSemua = function() {

            const harga = cleanNumber(inputHarga.value);
            const diskon = cleanNumber(inputDiskon.value);
            const bayar = cleanNumber(inputBayar.value);

            // Komisi & Insentif sekarang MANUAL dalam Rupiah.
            // Tidak lagi dihitung otomatis 20%.
            const komisi = cleanNumber(inputKomisi.value);
            const insentif = cleanNumber(inputInsentif.value);

            // Total tagihan = harga - diskon
            let totalTagihan = harga - diskon;

            if (totalTagihan < 0) {
                totalTagihan = 0;
            }

            // DPP dan PPN.
            // Asumsi harga sudah termasuk PPN 11%.
            const dpp = totalTagihan / 1.11;
            const ppn = totalTagihan - dpp;

            // Sisa piutang = total tagihan - pembayaran
            let piutang = totalTagihan - bayar;

            if (piutang < 0) {
                piutang = 0;
            }

            // Tampilkan hasil otomatis
            inputDPP.value = formatRupiah(Math.round(dpp));
            inputPPN.value = formatRupiah(Math.round(ppn));

            // Komisi dan Insentif TIDAK diubah oleh hitungSemua().
            // Nilainya berasal dari input manual user.

            inputTotal.value = formatRupiah(Math.round(totalTagihan));
            inputPiutang.value = formatRupiah(Math.round(piutang));

            console.log({
                harga: harga,
                diskon: diskon,
                bayar: bayar,
                dpp: Math.round(dpp),
                ppn: Math.round(ppn),
                komisiManual: komisi,
                insentifManual: insentif,
                totalTagihan: Math.round(totalTagihan),
                piutang: Math.round(piutang)
            });
        };


        // =========================================================
        // EVENT INPUT HARGA
        // =========================================================
        if (inputHarga) {
            inputHarga.addEventListener('input', function() {
                formatInput(this);
            });
        }


        // =========================================================
        // EVENT INPUT DISKON
        // =========================================================
        if (inputDiskon) {
            inputDiskon.addEventListener('input', function() {
                formatInput(this);
            });
        }


        // =========================================================
        // EVENT INPUT DP
        // =========================================================
        if (inputBayar) {
            inputBayar.addEventListener('input', function() {
                formatInput(this);
            });
        }


        // =========================================================
        // EVENT KOMISI MANUAL
        // =========================================================
        if (inputKomisi) {
            inputKomisi.addEventListener('input', function() {
                formatInput(this);
            });
        }


        // =========================================================
        // EVENT INSENTIF MANUAL
        // =========================================================
        if (inputInsentif) {
            inputInsentif.addEventListener('input', function() {
                formatInput(this);
            });
        }


        // =========================================================
        // HITUNG SAAT HALAMAN DIBUKA
        // =========================================================
        hitungSemua();
        });
    </script>
</x-app-layout>