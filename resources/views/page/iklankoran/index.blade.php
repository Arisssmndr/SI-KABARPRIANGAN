<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-kp-text tracking-tight">
                    Master Data Iklan Koran
                </h1>
                <p class="text-xs sm:text-sm text-kp-muted mt-0.5">
                    Daftar jenis dan kategori tarif iklan cetak Harian Umum Kabar Priangan
                </p>
            </div>
            <!-- Tombol Tambah Data (Trigger Modal) -->
            <div>
                <button type="button" 
                        onclick="openAddModal()" 
                        class="px-4 py-2.5 bg-kp-accent hover:bg-kp-accent-hover text-white text-xs font-bold rounded-xl shadow-xs transition duration-150">
                    + Tambah Jenis Iklan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Tabel Data 100% Lebar -->
        <div class="bg-white border border-kp-border rounded-2xl shadow-xs overflow-hidden">
            <div class="p-5 border-b border-kp-border flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-kp-text">Kategori Iklan Koran</h2>
                    <p class="text-xs text-kp-muted mt-0.5">Total terdaftar {{ $iklankoran->total() }} jenis tarif iklan</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-kp-border bg-kp-canvas text-kp-muted uppercase tracking-wider text-[11px]">
                            <th class="py-3 px-4 font-bold w-16 text-center">No</th>
                            <th class="py-3 px-4 font-bold w-36">Kode Iklan</th>
                            <th class="py-3 px-4 font-bold">Jenis Iklan Koran</th>
                            <th class="py-3 px-4 font-bold text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-kp-border">
                        @forelse($iklankoran as $key => $item)
                            <tr class="hover:bg-kp-canvas/60 transition">
                                <td class="py-3.5 px-4 text-center text-kp-muted">
                                    {{ $iklankoran->firstItem() + $key }}
                                </td>
                                <td class="py-3.5 px-4 font-bold text-kp-blue-700">
                                    {{ $item->kode_iklankoran }}
                                </td>
                                <td class="py-3.5 px-4 font-semibold text-kp-text text-sm">
                                    {{ $item->jenis_iklankoran }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" 
                                                onclick="openEditModal('{{ $item->id }}', '{{ $item->kode_iklankoran }}', '{{ addslashes($item->jenis_iklankoran) }}')"
                                                class="px-2.5 py-1 text-xs font-semibold text-kp-blue-700 bg-kp-blue-50 hover:bg-kp-blue-100 rounded-lg border border-kp-blue-200 transition">
                                            Ubah
                                        </button>
                                        <button type="button" 
                                                onclick="deleteItem('{{ $item->id }}', '{{ $item->kode_iklankoran }}')"
                                                class="px-2.5 py-1 text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 rounded-lg border border-red-200 transition">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-kp-muted">
                                    Belum ada data jenis iklan koran. Klik "+ Tambah Jenis Iklan" di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($iklankoran->hasPages())
                <div class="p-4 border-t border-kp-border bg-white">
                    {{ $iklankoran->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Tambah / Ubah Jenis Iklan (Clean & Modern) -->
    <div id="itemModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs hidden">
        <div class="bg-white border border-kp-border rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <!-- Header Modal -->
            <div class="px-6 py-4 border-b border-kp-border flex items-center justify-between bg-kp-canvas">
                <h3 id="modalTitle" class="text-base font-bold text-kp-text">
                    Tambah Jenis Iklan Koran
                </h3>
                <button type="button" onclick="closeModal()" class="text-xs font-bold text-kp-muted hover:text-kp-text px-2 py-1 rounded-md">
                    Tutup
                </button>
            </div>

            <!-- Form -->
            <form id="itemForm" method="POST" action="{{ route('iklankoran.store') }}" class="p-6 space-y-4">
                @csrf
                <div id="methodContainer"></div>

                <div>
                    <label class="block text-xs font-bold text-kp-muted uppercase tracking-wider mb-1.5">
                        Kode Iklan
                    </label>
                    <input type="text" 
                           id="modal_kode" 
                           name="kode_iklankoran" 
                           value="{{ $kode_iklankoran }}" 
                           readonly 
                           class="w-full px-3.5 py-2.5 bg-gray-100 border border-kp-border rounded-xl text-sm font-bold text-kp-text" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-kp-muted uppercase tracking-wider mb-1.5">
                        Nama / Jenis Iklan Koran
                    </label>
                    <input type="text" 
                           id="modal_jenis" 
                           name="jenis_iklankoran" 
                           required 
                           placeholder="Contoh: Iklan Display, Iklan Baris..."
                           class="w-full px-3.5 py-2.5 bg-white border border-kp-border rounded-xl text-sm text-kp-text focus:outline-none focus:border-kp-blue-600 focus:ring-2 focus:ring-kp-blue-100 transition" />
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-kp-border">
                    <button type="button" 
                            onclick="closeModal()" 
                            class="px-4 py-2 text-xs font-semibold text-kp-muted hover:bg-kp-canvas rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" 
                            id="submitButton"
                            class="px-5 py-2 bg-kp-blue-600 hover:bg-kp-blue-700 text-white text-xs font-bold rounded-xl shadow-xs transition">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function openAddModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Jenis Iklan Koran';
            document.getElementById('itemForm').action = "{{ route('iklankoran.store') }}";
            document.getElementById('methodContainer').innerHTML = '';
            document.getElementById('modal_kode').value = "{{ $kode_iklankoran }}";
            document.getElementById('modal_jenis').value = '';
            document.getElementById('submitButton').innerText = 'Simpan Data';
            
            document.getElementById('itemModal').classList.remove('hidden');
        }

        function openEditModal(id, kode, jenis) {
            document.getElementById('modalTitle').innerText = 'Ubah Jenis Iklan ' + kode;
            document.getElementById('itemForm').action = "/iklankoran/" + id;
            document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
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
                        await axios.post('/iklankoran/' + id, {
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
