<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('LAPORAN TRANSAKSI IKLAN ONLINE KABAR PRIANGAN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="p-4 bg-gray-100 mb-4 rounded-xl text-center font-bold">
                        CETAK LAPORAN TRANSAKSI IKLAN KABAR PRIANGAN
                    </div>

                    <form class="w-full mx-auto my-5" method="POST" action="{{ route('laporanonline.store') }}"
                        target="_blank">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                            <div>
                                <label for="dari"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dari
                                    Tanggal</label>
                                <input type="date" id="dari" name="dari" required
                                    value="{{ date('Y-m-01') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>

                            <div>
                                <label for="sampai"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sampai
                                    Tanggal</label>
                                <input type="date" id="sampai" name="sampai" required value="{{ date('Y-m-d') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>

                            <div>
                                <label for="status"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                    Pembayaran</label>
                                <select name="status" id="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="all">Semua Status</option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
                                </select>
                            </div>

                        </div>

                        <div class="flex justify-end gap-3 mt-6">

                            <button type="reset"
                                class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center">
                                <i class="fi fi-sr-refresh mr-2"></i> Reset
                            </button>

                            <button type="submit"
                                class="text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center flex items-center justify-center">
                                <i class="fi fi-sr-print mr-2"></i> Cetak Laporan
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
