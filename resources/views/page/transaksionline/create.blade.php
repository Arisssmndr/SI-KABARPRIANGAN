<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TRANSAKSI KABAR PRIANGAN ONLINE') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form class="space-y-6" method="POST" action="{{ route('transaksionline.store') }}">
                @csrf
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="border-b pb-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white uppercase">Form Input Transaksi Online
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
                                <input type="text" name="nofakturonline"
                                    value="{{ $nofakturonline ?? 'TRX-ONL-001' }}" readonly
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama
                                    Pemasang</label>
                                <input type="text" name="nama_pemasangonline" required placeholder="Nama Pemasang"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama
                                    Sales</label>
                                <input type="text" name="sales_iklanonline" required placeholder="Nama Sales"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>

                        </div>

                        <div class="space-y-4">

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                    Transaksi</label>
                                <input type="date" name="tanggal_transaksionline" required
                                    value="{{ date('Y-m-d') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Alamat
                                    Pemasang</label>
                                <textarea name="alamat_pemasangonline" rows="5" required placeholder="Alamat lengkap..."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></textarea>
                            </div>

                        </div>

                    </div>
                </div>

                {{-- kolom 2 --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jenis
                                Iklan</label>
                            <select name="id_iklanonline" id="id_iklanonline" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" disabled selected>Pilih Jenis Iklan...</option>
                                @foreach ($iklanonline as $io)
                                    <option value="{{ $io->id }}">
                                        {{ $io->jenis_iklanonline }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Portal
                                Iklan</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="portal_iklanonline">
                                <option value="">Pilih Portal...</option>
                                <option value="Kabar Priangan">Kabar Priangan</option>
                                <option value="Kabar Tasikmalaya">Kabar Tasikmalaya</option>
                                <option value="Kabar Singaparna">Kabar Singaparna</option>
                                <option value="Kabar Ciamis">Kabar Ciamis</option>
                                <option value="Kabar Banjar">Kabar Banjar</option>
                                <option value="Kabar Pangandaran">Kabar Pangandaran</option>
                                <option value="Kabar Garut">Kabar Garut</option>
                                <option value="Kabar Bandung">Kabar Bandung</option>
                                <option value="Kabar Sumedang">Kabar Sumedang</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                Muat</label>
                            <input type="date" name="tanggal_muatiklanonline" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Total Muat
                                (Kali)</label>
                            <input type="number" id="total_muatiklanonline" name="total_muatiklanonline" value="1"
                                min="1" required
                                class="bg-white border border-blue-500 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        </div>

                    </div>
                </div>
                {{-- Kolom 3 --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                            <h4 class="font-bold text-blue-800 mb-4">Rincian Pembayaran</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Harga
                                        Satuan (Manual)</label>
                                    <input type="text" id="harga_transaksionline" name="harga_transaksionline"
                                        required
                                        class="bg-white border border-blue-500 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Input Harga..." />
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Diskon
                                        (Rp)</label>
                                    <input type="text" id="diskon_transaksionline" name="diskon_transaksionline"
                                        value="0" required
                                        class="bg-white border border-blue-500 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jumlah
                                        Dibayar (DP)</label>
                                    <input type="text" id="jumlahbayar_transaksionline"
                                        name="jumlahbayar_transaksionline" value="0" required
                                       
                                        class="bg-white border border-green-500 text-gray-900 text-lg font-bold rounded-lg block w-full p-2.5" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- Kolom 4 --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                        <label class="block mb-1 font-medium text-gray-500">Insentif (Rp)</label>
                        <input type="text" id="insentif_transaksionline" name="insentif_transaksionline" value="0" class="bg-white border border-gray-200 text-gray-700 text-sm rounded block w-full p-2" />
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-500">Komisi (Rp)</label>
                        <input type="text" id="komisi_transaksionline" name="komisi_transaksionline" value="0" class="bg-white border border-gray-200 text-gray-700 text-sm rounded block w-full p-2" />
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-500">PPN (11%)</label>
                        <input type="text" id="ppn_transaksionline" name="ppn_transaksionline" readonly value="0" class="bg-gray-100 border border-gray-200 text-gray-700 text-sm rounded block w-full p-2" />
                    </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-500">DPP</label>
                            <input type="text" id="dpp_transaksionline" name="dpp_transaksionline" readonly value="0"
                                class="bg-gray-100 border border-gray-200 text-gray-700 text-sm rounded block w-full p-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">TOTAL
                                TAGIHAN</label>
                            <input type="text" id="totaltagihan_transaksionline"
                                name="totaltagihan_transaksionline" readonly value="0"
                                class="bg-gray-800 border border-gray-300 text-white text-sm rounded-lg block w-full p-2.5" />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-bold text-red-600 dark:text-white">SISA
                                PIUTANG</label>
                            <input type="text" id="piutang_transaksionline" name="piutang_transaksionline"
                                readonly value="0"
                                class="bg-red-100 text-red-600 border border-red-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                        <a href="{{ route('transaksionline.index') }}"
                            class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-8 py-2.5 text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center shadow-lg">
                            Simpan Transaksi
                        </button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <script>
    // =========================================================
    // HELPER FORMAT RUPIAH
    // =========================================================
    function formatRupiah(angka) {
        if (angka === null || angka === undefined || isNaN(angka)) {
            return '0';
        }

        return new Intl.NumberFormat('id-ID').format(angka);
    }


    // =========================================================
    // HELPER MEMBERSIHKAN FORMAT RUPIAH
    //
    // Contoh:
    // "125.000"  -> 125000
    // "1.500.000" -> 1500000
    // =========================================================
    function cleanNumber(rupiah) {
        if (rupiah === null || rupiah === undefined || rupiah === '') {
            return 0;
        }

        return parseFloat(
            rupiah.toString().replace(/[^0-9]/g, '')
        ) || 0;
    }


    // =========================================================
    // FORMAT INPUT RUPIAH
    // =========================================================
    function formatInput(input) {
        if (!input) return;

        const nilai = cleanNumber(input.value);

        input.value = formatRupiah(nilai);

        hitungSemua();
    }


    // =========================================================
    // SETELAH HALAMAN SELESAI DIMUAT
    // =========================================================
    document.addEventListener('DOMContentLoaded', function () {

        // =====================================================
        // INPUT UTAMA
        // =====================================================

        const inputTotalMuat =
            document.getElementById('total_muatiklanonline');

        const inputHarga =
            document.getElementById('harga_transaksionline');

        const inputDiskon =
            document.getElementById('diskon_transaksionline');

        const inputBayar =
            document.getElementById('jumlahbayar_transaksionline');


        // =====================================================
        // INSENTIF & KOMISI
        //
        // KEDUANYA MANUAL DALAM RUPIAH
        // TIDAK ADA PERHITUNGAN 20%
        // =====================================================

        const inputInsentif =
            document.getElementById('insentif_transaksionline');

        const inputKomisi =
            document.getElementById('komisi_transaksionline');


        // =====================================================
        // OUTPUT PERHITUNGAN
        // =====================================================

        const inputDPP =
            document.getElementById('dpp_transaksionline');

        const inputPPN =
            document.getElementById('ppn_transaksionline');

        const inputTotal =
            document.getElementById('totaltagihan_transaksionline');

        const inputPiutang =
            document.getElementById('piutang_transaksionline');


        // =====================================================
        // FUNGSI PERHITUNGAN UTAMA
        // =====================================================

        window.hitungSemua = function () {

            // -------------------------------------------------
            // CEK ELEMENT
            // -------------------------------------------------

            if (
                !inputHarga ||
                !inputDPP ||
                !inputPPN ||
                !inputTotal ||
                !inputPiutang
            ) {
                console.error(
                    'Element perhitungan tidak ditemukan.'
                );

                return;
            }


            // =================================================
            // 1. AMBIL NILAI HARGA
            // =================================================

            const harga =
                cleanNumber(inputHarga.value);


            // =================================================
            // 2. AMBIL DISKON
            // =================================================

            const diskon =
                inputDiskon
                    ? cleanNumber(inputDiskon.value)
                    : 0;


            // =================================================
            // 3. AMBIL DP / JUMLAH DIBAYAR
            // =================================================

            const bayar =
                inputBayar
                    ? cleanNumber(inputBayar.value)
                    : 0;


            // =================================================
            // 4. AMBIL INSENTIF MANUAL
            //
            // HANYA DIBACA SEBAGAI NOMINAL RUPIAH
            // TIDAK ADA 20%
            // =================================================

            const insentif =
                inputInsentif
                    ? cleanNumber(inputInsentif.value)
                    : 0;


            // =================================================
            // 5. AMBIL KOMISI MANUAL
            //
            // HANYA DIBACA SEBAGAI NOMINAL RUPIAH
            // TIDAK ADA 20%
            // =================================================

            const komisi =
                inputKomisi
                    ? cleanNumber(inputKomisi.value)
                    : 0;


            // =================================================
            // 6. JUMLAH / QTY
            // =================================================

            let qty = 1;

            if (inputTotalMuat) {
                qty =
                    parseFloat(inputTotalMuat.value) || 1;
            }


            // =================================================
            // 7. HITUNG OMSET KOTOR
            // =================================================

            const omsetKotor =
                harga * qty;


            // =================================================
            // 8. KURANGI DISKON
            // =================================================

            let totalTagihan =
                omsetKotor - diskon;


            // Jangan sampai negatif
            if (totalTagihan < 0) {
                totalTagihan = 0;
            }


            // =================================================
            // 9. HITUNG DPP
            //
            // ASUMSI HARGA SUDAH TERMASUK PPN 11%
            //
            // DPP = Total / 1.11
            // =================================================

            const dpp =
                totalTagihan / 1.11;


            // =================================================
            // 10. HITUNG PPN 11%
            // =================================================

            const ppn =
                totalTagihan - dpp;


            // =================================================
            // 11. HITUNG SISA PIUTANG
            // =================================================

            let piutang =
                totalTagihan - bayar;


            // Jangan sampai piutang negatif
            if (piutang < 0) {
                piutang = 0;
            }


            // =================================================
            // 12. TAMPILKAN TOTAL TAGIHAN
            // =================================================

            inputTotal.value =
                formatRupiah(
                    Math.round(totalTagihan)
                );


            // =================================================
            // 13. TAMPILKAN DPP
            // =================================================

            inputDPP.value =
                formatRupiah(
                    Math.round(dpp)
                );


            // =================================================
            // 14. TAMPILKAN PPN
            // =================================================

            inputPPN.value =
                formatRupiah(
                    Math.round(ppn)
                );


            // =================================================
            // 15. TAMPILKAN SISA PIUTANG
            // =================================================

            inputPiutang.value =
                formatRupiah(
                    Math.round(piutang)
                );


            // =================================================
            // DEBUG
            // Bisa dilihat melalui F12 > Console
            // =================================================

            console.log({
                harga: harga,
                qty: qty,
                omsetKotor: omsetKotor,
                diskon: diskon,
                insentif: insentif,
                komisi: komisi,
                dpp: Math.round(dpp),
                ppn: Math.round(ppn),
                totalTagihan: Math.round(totalTagihan),
                bayar: bayar,
                piutang: Math.round(piutang)
            });
        };


        // =====================================================
        // EVENT HARGA
        // =====================================================

        if (inputHarga) {

            inputHarga.addEventListener(
                'input',
                function () {
                    formatInput(this);
                }
            );
        }


        // =====================================================
        // EVENT DISKON
        // =====================================================

        if (inputDiskon) {

            inputDiskon.addEventListener(
                'input',
                function () {
                    formatInput(this);
                }
            );
        }


        // =====================================================
        // EVENT DP / JUMLAH BAYAR
        // =====================================================

        if (inputBayar) {

            inputBayar.addEventListener(
                'input',
                function () {
                    formatInput(this);
                }
            );
        }


        // =====================================================
        // EVENT INSENTIF
        //
        // MANUAL RUPIAH
        // =====================================================

        if (inputInsentif) {

            inputInsentif.addEventListener(
                'input',
                function () {
                    formatInput(this);
                }
            );
        }


        // =====================================================
        // EVENT KOMISI
        //
        // MANUAL RUPIAH
        // =====================================================

        if (inputKomisi) {

            inputKomisi.addEventListener(
                'input',
                function () {
                    formatInput(this);
                }
            );
        }


        // =====================================================
        // EVENT JUMLAH MUAT / QTY
        // =====================================================

        if (
            inputTotalMuat &&
            inputTotalMuat.addEventListener
        ) {

            inputTotalMuat.addEventListener(
                'input',
                function () {
                    hitungSemua();
                }
            );
        }


        // =====================================================
        // DROPDOWN JENIS IKLAN
        // =====================================================

        const selectJenis =
            document.getElementById('id_iklanonline');


        if (selectJenis) {

            selectJenis.addEventListener(
                'change',
                function () {

                    const selectedOption =
                        this.options[this.selectedIndex];


                    const hargaDb =
                        parseFloat(
                            selectedOption.dataset.harga
                        ) || 0;


                    if (inputHarga) {

                        inputHarga.value =
                            formatRupiah(hargaDb);

                        hitungSemua();
                    }
                }
            );
        }


        // =====================================================
        // HITUNG OTOMATIS SAAT HALAMAN PERTAMA KALI DIBUKA
        // =====================================================

        hitungSemua();

    });
</script>
</x-app-layout>
