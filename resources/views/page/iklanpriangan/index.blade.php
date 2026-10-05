<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('IKLAN ONLINE PRIANGAN TV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="gap-5 items-start flex">
                <div class="bg-blue-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3 p-4">
                    <div class="p-4 bg-gray-100 mb-2 rounded-xl font-bold">
                        FORM IKLAN PRIANGAN TV
                    </div>
                    <div>
                        <form class="max-w-sm mx-auto" method="POST" action="{{ route('iklanpriangan.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="kode_iklanpriangan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Iklan
                                </label>
                                <input type="text" name="kode_iklanpriangan"
                                    value="{{ $kode_iklanpriangan ?? 'error' }}" readonly
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" " />
                            </div>
                            <div class="mb-3">
                                <label for="jenis_iklanpriangan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Iklan</label>
                                <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                    name="jenis_iklanpriangan" data-placeholder="Pilih Jenis Iklan">
                                    <option value="">Pilih...</option>
                                    <option value="Podcast">Podcast</option>
                                    <option value="Iklan Display">Iklan Display</option>
                                    <option value="Iklan Video ">Iklan Video</option>
                                </select>
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="bg-blue-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-4">
                    <div class="p-4 text-center bg-gray-100 mb-2 rounded-xl font-bold">
                        TABEL DATA IKLAN PRIANGAN TV
                    </div>
                    <div>
                        <div class="relative overflow-x-auto rounded-xl">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 bg-gray-100">
                                            NO
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-100">
                                            KODE IKLAN
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-100">
                                            JENIS IKLAN
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-100">
                                            ACTION
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                     @foreach ($iklanpriangan as $key=> $i)
                                <tr class="text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700 px-4"
                                    align="center">
                                    <th scope="row"
                                        class="px-5 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $no++ }}
                                    </th>
                                    <td class="px-5 py-3">
                                        {{ $i->kode_iklanpriangan }}
                                    </td>
                                    <td class="px-5 py-3">
                                        {{ $i->jenis_iklanpriangan }}
                                    </td>
                                    <td class="px-5 py-3">
                                        <button type="button"
                                            class="bg-amber-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-amber-500"
                                            onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                            data-id="{{ $i->id }}"
                                            data-kode_iklanpriangan="{{ $i->kode_iklanpriangan }}"
                                            data-jenis_iklanpriangan="{{ $i->jenis_iklanpriangan }}"
                                            title="Edit Data">
                                            <i class="fi fi-sr-file-edit"></i>
                                        </button>
                                        <button class="bg-red-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-red-500"
                                            onclick="return iklanprianganDelete('{{ $i->id }}','{{ $i->kode_iklanpriangan }}')"
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
                                {{ $iklanpriangan->links() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full max-w-md relative bg-white rounded-lg shadow mx-4">

                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900" id="title_source">
                        Update Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col p-4 space-y-3 max-h-[75vh] overflow-y-auto">
                        <div>
                            <label for="kode_iklanpriangan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Iklan
                            </label>
                            <input type="text" id="edit_kode_iklanpriangan" name="kode_iklanpriangan"
                                value="{{ $kode_iklanpriangan }}" readonly
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" " />
                        </div>
                        <div>
                            <label for="jenis_iklanpriangan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Iklan</label>
                                <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                    name="jenis_iklanpriangan" id="edit_jenis_iklanpriangan" data-placeholder="Pilih Jenis Iklan">
                                    <option value="">Pilih...</option>
                                    <option value="Podcast">Podcast</option>
                                    <option value="Iklan Display">Iklan Display</option>
                                    <option value="Iklan Video">Iklan Video</option>
                                </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-blue-700">
                            Batal
                        </button>
                        <button type="submit" id="formSourceButton"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modalTarget = button.dataset.modalTarget;

        // 1. Ambil Data dari Tombol
        const id = button.dataset.id;
        const kode = button.dataset.kode_iklanpriangan;
        const jenis = button.dataset.jenis_iklanpriangan;

        // 2. Update URL Action Form
        // Mengubah route menjadi .../update/ID
        let url = "{{ route('iklanpriangan.update', ':id') }}".replace(':id', id);
        formModal.setAttribute('action', url);

        // 3. Update Tampilan Modal (Judul & Tombol)
        let status = document.getElementById(modalTarget);
        document.getElementById('title_source').innerText = `UPDATE ${kode}`;
        document.getElementById('formSourceButton').innerText = 'Simpan Perubahan';

        // 4. Masukkan Data ke Input Field
        document.getElementById('edit_kode_iklanpriangan').value = kode;

        $('#edit_jenis_iklanpriangan').val(jenis).trigger('change');

        // 5. Menangani METHOD PATCH (Agar tidak duplikat)
        // Cek dulu, apakah input _method sudah ada?
        let methodInput = formModal.querySelector('input[name="_method"]');
        if (!methodInput) {
            // Jika belum ada, baru kita buat
            methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            formModal.appendChild(methodInput);
        }
        // Isi valuenya dengan PATCH
        methodInput.setAttribute('value', 'PATCH');

        // 6. Menangani CSRF TOKEN (Penting!)
        // Cek dulu apakah token sudah ada
        let csrfInput = formModal.querySelector('input[name="_token"]');
        if (!csrfInput) {
            csrfInput = document.createElement('input');
            csrfInput.setAttribute('type', 'hidden');
            csrfInput.setAttribute('name', '_token'); // <--- INI WAJIB ADA
            formModal.appendChild(csrfInput);
        }
        csrfInput.setAttribute('value', '{{ csrf_token() }}');

        // 7. Buka Modal
        // Gunakan remove('hidden') agar pasti terbuka
        status.classList.remove('hidden');
        status.classList.add('flex'); // Pastikan display flex agar modal ke tengah
    }

    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget;
        let status = document.getElementById(modalTarget);
        status.classList.toggle('hidden');
    }

    // --- 4. Delete Logic dengan SweetAlert ---
    const iklanprianganDelete = async (id, kode_iklanpriangan) => {
        // Tampilkan SweetAlert Konfirmasi
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: `Data faktur ${kode_iklanpriangan} akan dihapus permanen!`,
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
                    const response = await axios.post(`/iklanpriangan/${id}`, {
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
