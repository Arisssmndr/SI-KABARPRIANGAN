<x-app-layout>
    <div class="space-y-5">

        <!-- Header Halaman Langsung di Konten -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-black tracking-tight">
                    Master Data Iklan Priangan TV
                </h1>
                <p class="text-xs text-gray-600 mt-0.5">
                    Kategori tarif dan jenis iklan siaran Priangan TV
                </p>
            </div>
            <div>
                <button type="button" 
                        onclick="openAddModal()" 
                        class="inline-flex items-center px-4 py-2 bg-kp-blue-600 hover:bg-kp-blue-700 active:bg-kp-blue-800 text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                    + Tambah Data
                </button>
            </div>
        </div>

        <!-- Tabel Data Penuh 100% -->
        <div class="bg-white border border-slate-300 rounded-xl shadow-xs overflow-hidden">
            <div class="px-5 py-4 bg-slate-50/90 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Kategori Iklan Priangan TV</h2>
                    <p class="text-xs text-slate-500 mt-0.5 font-normal">Total terdaftar {{ $iklanpriangan->total() }} jenis tarif siaran</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-300 bg-slate-100 text-slate-800 uppercase tracking-wider text-[11px]">
                            <th class="py-3.5 px-4 font-bold w-16 text-center">No</th>
                            <th class="py-3.5 px-4 font-bold w-36">Kode Iklan</th>
                            <th class="py-3.5 px-4 font-bold">Jenis Iklan TV</th>
                            <th class="py-3.5 px-4 font-bold text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($iklanpriangan as $key => $p)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3.5 px-4 text-center text-gray-500 font-normal">
                                    {{ $iklanpriangan->firstItem() + $key }}
                                </td>
                                <td class="py-3.5 px-4 font-medium text-black">
                                    {{ $p->kode_iklanpriangan }}
                                </td>
                                <td class="py-3.5 px-4 font-normal text-black text-sm">
                                    {{ $p->jenis_iklanpriangan }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" 
                                                onclick="openEditModal('{{ $p->id }}', '{{ $p->kode_iklanpriangan }}', '{{ addslashes($p->jenis_iklanpriangan) }}')"
                                                class="px-2.5 py-1 text-xs font-medium text-kp-blue-700 bg-kp-blue-50 hover:bg-kp-blue-100 rounded-md border border-kp-blue-200 transition cursor-pointer">
                                            Ubah
                                        </button>
                                        <button type="button" 
                                                onclick="deleteItem('{{ $p->id }}', '{{ $p->kode_iklanpriangan }}')"
                                                class="px-2.5 py-1 text-xs font-medium text-red-600 bg-white hover:bg-red-50 rounded-md border border-red-200 transition cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-slate-500 font-normal">
                                    Belum ada data tarif iklan. Klik "+ Tambah Data" untuk menambah data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($iklanpriangan->hasPages())
                <div class="p-4 border-t border-slate-200 bg-white">
                    {{ $iklanpriangan->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Form -->
    <div id="itemModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs hidden">
        <div class="bg-white border border-slate-200 rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                <h3 id="modalTitle" class="text-sm font-semibold text-black">
                    Tambah Jenis Iklan Priangan TV
                </h3>
                <button type="button" onclick="closeModal()" class="text-xs font-medium text-gray-500 hover:text-black px-2 py-1 cursor-pointer">
                    Tutup
                </button>
            </div>

            <form id="itemForm" method="POST" action="{{ route('iklanpriangan.store') }}" class="p-6 space-y-4">
                @csrf
                <div id="methodContainer"></div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Kode Iklan
                    </label>
                    <input type="text" 
                           id="modal_kode" 
                           name="kode_iklanpriangan" 
                           value="{{ $kode_iklanpriangan }}" 
                           readonly 
                           class="w-full px-3.5 py-2.5 bg-slate-100 border border-slate-300 rounded-lg text-sm font-medium text-black" />
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Nama / Jenis Iklan TV
                    </label>
                    <input type="text" 
                           id="modal_jenis" 
                           name="jenis_iklanpriangan" 
                           required 
                           placeholder="Contoh: Podcast, Running Text, Iklan Display, Iklan Video..."
                           class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm text-black placeholder-gray-400 focus:outline-none focus:border-kp-blue-600 focus:ring-2 focus:ring-kp-blue-100 transition" />
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-200">
                    <button type="button" 
                            onclick="closeModal()" 
                            class="px-4 py-2 text-xs font-medium text-gray-600 hover:bg-slate-100 rounded-lg transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" 
                            id="submitButton"
                            class="px-4 py-2 bg-kp-blue-600 hover:bg-kp-blue-700 text-white text-xs font-medium rounded-lg shadow-xs transition cursor-pointer">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function openAddModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Jenis Iklan Priangan TV';
            document.getElementById('itemForm').action = "{{ route('iklanpriangan.store') }}";
            document.getElementById('methodContainer').innerHTML = '';
            document.getElementById('modal_kode').value = "{{ $kode_iklanpriangan }}";
            document.getElementById('modal_jenis').value = '';
            document.getElementById('submitButton').innerText = 'Simpan Data';

            document.getElementById('itemModal').classList.remove('hidden');
        }

        function openEditModal(id, kode, jenis) {
            document.getElementById('modalTitle').innerText = 'Ubah Jenis Iklan ' + kode;
            document.getElementById('itemForm').action = "/iklanpriangan/" + id;
            document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PATCH">';
            document.getElementById('modal_kode').value = kode;
            document.getElementById('modal_jenis').value = jenis;
            document.getElementById('submitButton').innerText = 'Perbarui Data';

            document.getElementById('itemModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('itemModal').classList.add('hidden');
        }

        async function deleteItem(id, kode) {
            Swal.fire({
                title: 'Hapus Jenis Iklan?',
                text: 'Data ' + kode + ' akan dihapus dari sistem secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus Data',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]').content;
                        await axios.post('/iklanpriangan/' + id, {
                            _method: 'DELETE',
                            _token: token
                        });
                        Swal.fire({
                            title: 'Terhapus',
                            text: 'Data jenis iklan berhasil dihapus.',
                            icon: 'success',
                            confirmButtonColor: '#0A72AC',
                        }).then(() => location.reload());
                    } catch (error) {
                        Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
                    }
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
