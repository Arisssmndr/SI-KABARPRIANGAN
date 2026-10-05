<x-guest-layout>
    <div class="bg-white border border-kp-border rounded-2xl shadow-sm p-8 sm:p-10">
        <!-- Logo & Identitas Perusahaan Masuk ke Dalam Form -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/kabarpriangan.png') }}" 
                     alt="Logo Kabar Priangan" 
                     class="h-20 w-auto object-contain drop-shadow-sm" 
                     onerror="this.src='{{ asset('logo.png') }}'">
            </div>
            <h1 class="text-2xl font-bold text-kp-text tracking-tight">
                SIKAPRI
            </h1>
            <p class="text-xs font-semibold text-kp-blue-600 uppercase tracking-wider mt-1">
                Sistem Kasir Iklan Kabar Priangan
            </p>
            <p class="text-sm text-kp-muted mt-2">
                Silakan masuk dengan akun kasir Anda
            </p>
        </div>

        <!-- Status Sesi -->
        <x-auth-session-status class="mb-4 text-sm text-green-700 bg-green-50 p-3 rounded-lg border border-green-200" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-kp-text mb-1.5">
                    Alamat Email
                </label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="nama@kabarpriangan.com"
                       class="w-full px-4 py-2.5 bg-white border border-kp-border rounded-xl text-sm text-kp-text placeholder-gray-400 focus:outline-none focus:border-kp-blue-600 focus:ring-2 focus:ring-kp-blue-100 transition" />
                <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-kp-text mb-1.5">
                    Kata Sandi
                </label>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="Masukkan kata sandi"
                       class="w-full px-4 py-2.5 bg-white border border-kp-border rounded-xl text-sm text-kp-text placeholder-gray-400 focus:outline-none focus:border-kp-blue-600 focus:ring-2 focus:ring-kp-blue-100 transition" />
                <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember" 
                       class="w-4 h-4 text-kp-blue-600 border-gray-300 rounded focus:ring-kp-blue-500" />
                <label for="remember_me" class="ms-2 text-sm text-kp-muted select-none cursor-pointer">
                    Ingat saya di perangkat ini
                </label>
            </div>

            <!-- Tombol Masuk -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-3 px-4 bg-kp-blue-600 hover:bg-kp-blue-700 active:bg-kp-blue-800 text-white font-semibold text-sm rounded-xl shadow-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-kp-blue-400 focus:ring-offset-2">
                    Masuk ke Sistem
                </button>
            </div>
        </form>

        <!-- Footer Card -->
        <div class="mt-8 pt-5 border-t border-kp-border text-center">
            <p class="text-xs text-kp-muted">
                &copy; {{ date('Y') }} Harian Umum Kabar Priangan
            </p>
            <p class="text-[11px] text-gray-400 mt-0.5">
                Media Terpercaya Priangan Timur · Jawa Barat
            </p>
        </div>
    </div>
</x-guest-layout>
