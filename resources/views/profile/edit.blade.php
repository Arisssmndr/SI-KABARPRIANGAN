<x-app-layout>
    <div class="max-w-4xl space-y-6">
        <!-- Header Halaman Langsung di Konten -->
        <div>
            <h1 class="text-xl font-bold text-black tracking-tight">
                Profil Pengguna Kasir
            </h1>
            <p class="text-xs text-gray-600 mt-0.5">
                Pengaturan akun kasir, kata sandi, dan keamanan sistem
            </p>
        </div>

        <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-xs">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-xs">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-xs">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
