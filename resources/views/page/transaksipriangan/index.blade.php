<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-900 leading-tight">
            {{ __('DATA TRANSAKSI IKLAN PRIANGAN TV') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-[95%] mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="p-4 bg-gray-100 rounded-xl mb-4 font-bold flex items-center justify-between ">
                        <div>DAFTAR TRANSAKSI IKLAN PRIANGAN TV</div>
                        <div>
                            <a href="{{ route('transaksipriangan.create') }}"
                                class="bg-amber-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-amber-500 justify-between">
                                <i class="fi fi-sr-square-plus p-" title="Tambah Data"></i></a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto rounded-xl">
                        <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="text-center font-semibold whitespace-nowrap">
                                    <th class="px-4 py-3">NO</th>
                                    <th class="px-4 py-3">NO FAKTUR</th>
                                    <th class="px-4 py-3">TGL TRANSAKSI</th>
                                    <th class="px-4 py-3">PEMASANG</th>
                                    <th class="px-4 py-3">ALAMAT</th>
                                    <th class="px-4 py-3">SALES</th>
                                    <th class="px-4 py-3">JENIS IKLAN</th>
                                    <th class="px-4 py-3">TGL MUAT</th>
                                    <th class="px-4 py-3">HARGA</th>
                                    <th class="px-4 py-3">DIBAYAR</th>
                                    <th class="px-4 py-3">PIUTANG</th>
                                    <th class="px-4 py-3">STATUS</th>
                                    <th class="px-4 py-3">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksipriangan as $key => $t)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 whitespace-nowrap"
                                        align="center">

                                        <th class="px-6 py-4 font-medium">{{ $transaksipriangan->firstItem() + $key }}
                                        </th>
                                        <td class="px-4 py-3">{{ $t->nofakturpriangan }}</td>
                                        <td class="px-4 py-3">{{ $t->tanggal_transaksipriangan }}</td>
                                        <td class="px-4 py-3">{{ $t->nama_pemasangpriangan }}</td>
                                        <td class="px-4 py-3">{{ Str::limit($t->alamat_pemasangpriangan, 20) }}</td>
                                        <td class="px-4 py-3">{{ $t->sales_iklanpriangan }}</td>
                                        {{-- Relasi Iklan --}}
                                        <td class="px-4 py-3">{{ $t->iklanpriangan->jenis_iklanpriangan ?? '-' }}</td>

                                        <td class="px-4 py-3">{{ $t->tanggal_muatiklanpriangan }}</td>

                                        {{-- Angka Rupiah --}}
                                        <td class="px-4 py-3">Rp
                                            {{ number_format($t->harga_transaksipriangan, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">Rp
                                            {{ number_format($t->jumlahbayar_transaksipriangan, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 font-bold text-red-600">
                                            Rp {{ number_format($t->piutang_transaksipriangan, 0, ',', '.') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            @if ($t->piutang_transaksipriangan > 0)
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Belum
                                                    Lunas</span>
                                            @else
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Lunas</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 flex justify-center gap-2">

                                            {{-- TOMBOL EDIT --}}
                                            <button type="button" onclick="editSourceModal(this)"
                                                data-id="{{ $t->id }}"
                                                data-nofakturpriangan="{{ $t->nofakturpriangan }}"
                                                data-tanggal_transaksipriangan="{{ $t->tanggal_transaksipriangan }}"
                                                data-nama_pemasangpriangan="{{ $t->nama_pemasangpriangan }}"
                                                data-alamat_pemasangpriangan="{{ $t->alamat_pemasangpriangan }}"
                                                data-id_iklanpriangan="{{ $t->id_iklanpriangan }}"
                                                data-sales_iklanpriangan="{{ $t->sales_iklanpriangan }}"
                                                data-tanggal_muatiklanpriangan="{{ $t->tanggal_muatiklanpriangan }}"
                                                data-harga="{{ $t->harga_transaksipriangan }}"
                                                data-bayar="{{ $t->jumlahbayar_transaksipriangan }}"
                                                data-piutang="{{ $t->piutang_transaksipriangan }}"
                                                class="bg-amber-500 hover:bg-amber-600 px-3 py-2 rounded-lg text-white"
                                                title="Edit Data">
                                                <i class="fi fi-sr-file-edit"></i>
                                            </button>

                                            {{-- TOMBOL PRINT (BARU) --}}
                                            <a href="{{ route('transaksipriangan.cetak', $t->id) }}" target="_blank"
                                                class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded-lg text-white"
                                                title="Cetak Transaksi">
                                                <i class="fi fi-sr-print"></i>
                                            </a>

                                            {{-- TOMBOL DELETE --}}
                                            <button
                                                onclick="return transaksiprianganDelete('{{ $t->id }}', '{{ $t->nofakturpriangan }}')"
                                                class="bg-red-500 hover:bg-red-600 px-3 py-2 rounded-lg text-white"
                                                title="Hapus Data">
                                                <i class="fi fi-sr-delete-document"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $transaksipriangan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden" id="sourceModal">
        <div class="relative w-full max-w-3xl max-h-screen overflow-y-auto bg-white rounded-lg shadow mx-4 my-8">
            <div class="flex items-start justify-between p-4 border-b rounded-t bg-gray-100">
                <h3 class="text-xl font-semibold text-gray-900" id="title_source">Update Transaksi</h3>
                <button type="button" onclick="sourceModalClose()" class="text-gray-400 hover:text-gray-900">
                    <i class="fa-solid fa-xmark fa-xl"></i>
                </button>
            </div>

            <form class="w-full px-6 py-4" method="POST" id="formSourceModal">
                @csrf
                <div class="flex flex-col gap-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 text-sm font-medium">No Faktur</label>
                            <input type="text" id="edit_nofakturpriangan" name="nofakturpriangan" readonly
                                class="bg-gray-200 border border-gray-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium">Tanggal Transaksi</label>
                            <input type="date" id="edit_tanggal_transaksipriangan" name="tanggal_transaksipriangan"
                                required
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 text-sm font-medium">Nama Pemasang</label>
                            <input type="text" id="edit_nama_pemasangpriangan" name="nama_pemasangpriangan"
                                required
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium">Alamat</label>
                            <input type="text" id="edit_alamat_pemasangpriangan" name="alamat_pemasangpriangan"
                                required
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium">Sales</label>
                            <input type="text" id="edit_sales_iklanpriangan" name="sales_iklanpriangan" required
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 text-sm font-medium">Jenis Iklan</label>
                            <select name="id_iklanpriangan" id="edit_id_iklanpriangan" required
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                                <option value="">Pilih...</option>
                                @foreach ($iklanpriangan as $ip)
                                    <option value="{{ $ip->id }}">{{ $ip->jenis_iklanpriangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium">Tanggal Muat</label>
                            <input type="date" id="edit_tanggal_muatiklanpriangan"
                                name="tanggal_muatiklanpriangan" required
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>

                    <hr class="border-gray-300 my-2">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-blue-50 p-4 rounded-lg">
                        <div>
                            <label class="block mb-1 text-sm font-bold text-blue-900">Harga (Manual)</label>
                            <input type="text" id="edit_harga_transaksipriangan" name="harga_transaksipriangan"
                                required onkeyup="formatInput(this)"
                                class="bg-white border border-blue-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-bold text-blue-900">Jumlah Bayar</label>
                            <input type="text" id="edit_jumlahbayar_transaksipriangan"
                                name="jumlahbayar_transaksipriangan" required onkeyup="formatInput(this)"
                                class="bg-white border border-blue-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-bold text-red-900">Sisa Piutang</label>
                            <input type="text" id="edit_piutang_transaksipriangan"
                                name="piutang_transaksipriangan" readonly
                                class="bg-red-100 border border-red-300 text-red-700 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end p-4 space-x-2 border-t border-gray-200 mt-4">
                    <button type="button" onclick="sourceModalClose()"
                        class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5">Batal</button>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    // --- Helper Functions ---
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
        hitungEdit();
    }

    // --- Edit Modal Logic ---
    const editSourceModal = (button) => {
        const modal = document.getElementById('sourceModal');
        const form = document.getElementById('formSourceModal');
        const d = button.dataset;

        // Set URL Action
        let url = "{{ route('transaksipriangan.update', ':id') }}".replace(':id', d.id);
        form.action = url;

        // Add PUT Method
        if (!form.querySelector('input[name="_method"]')) {
            const m = document.createElement('input');
            m.type = 'hidden';
            m.name = '_method';
            m.value = 'PUT';
            form.appendChild(m);
        }

        // Fill Fields
        document.getElementById('edit_nofakturpriangan').value = d.nofakturpriangan;
        document.getElementById('edit_tanggal_transaksipriangan').value = d.tanggal_transaksipriangan;
        document.getElementById('edit_nama_pemasangpriangan').value = d.nama_pemasangpriangan;
        document.getElementById('edit_alamat_pemasangpriangan').value = d.alamat_pemasangpriangan;
        document.getElementById('edit_id_iklanpriangan').value = d.id_iklanpriangan;
        document.getElementById('edit_sales_iklanpriangan').value = d.sales_iklanpriangan;
        document.getElementById('edit_tanggal_muatiklanpriangan').value = d.tanggal_muatiklanpriangan;

        // Fill Numbers
        document.getElementById('edit_harga_transaksipriangan').value = formatRupiah(d.harga);
        document.getElementById('edit_jumlahbayar_transaksipriangan').value = formatRupiah(d.bayar);
        document.getElementById('edit_piutang_transaksipriangan').value = formatRupiah(d.piutang);

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    const sourceModalClose = () => {
        const modal = document.getElementById('sourceModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    // --- Calculator Logic ---
    function hitungEdit() {
        const harga = cleanNumber(document.getElementById('edit_harga_transaksipriangan').value);
        const bayar = cleanNumber(document.getElementById('edit_jumlahbayar_transaksipriangan').value);

        let sisa = harga - bayar;
        if (sisa < 0) sisa = 0;

        document.getElementById('edit_piutang_transaksipriangan').value = formatRupiah(sisa);
    }

    // --- Delete Logic ---
    const transaksiprianganDelete = async (id, nofakturpriangan) => {
        // Tampilkan SweetAlert Konfirmasi
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: `Data faktur ${nofakturpriangan} akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33', // Warna merah untuk tombol hapus
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            // Jika user klik tombol "Ya, Hapus!"
            if (result.isConfirmed) {
                try {
                    // Panggil Axios Delete
                    const response = await axios.post(`/transaksipriangan/${id}`, {
                        '_method': 'DELETE',
                        '_token': document.querySelector('meta[name="csrf-token"]').content
                    });

                    // Jika sukses, munculkan pesan Sukses lalu reload
                    Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });

                } catch (error) {
                    // Jika gagal
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                    console.error(error);
                }
            }
        });
    };
</script>
