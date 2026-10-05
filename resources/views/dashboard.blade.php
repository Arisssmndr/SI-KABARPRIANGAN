<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Selamat Datang') }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8 rounded-xl shadow-lg">
                <h1 class="text-3xl font-bold mb-2">Aplikasi Kasir Kabar Priangan</h1>
                <p class="text-lg opacity-90">Selamat datang kembali! Semoga harimu menyenangkan.</p>
            </div>

            <div class="mt-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-800 text-lg">
                        Anda berhasil login. Silakan pilih menu di sebelah kiri untuk mulai menggunakan aplikasi.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
