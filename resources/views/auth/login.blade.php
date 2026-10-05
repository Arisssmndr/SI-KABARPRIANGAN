<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="relative py-3 sm:max-w-xs sm:mx-auto">

            <form method="POST" action="{{ route('login') }}">
                @csrf <div class="flex flex-col justify-center items-center h-full select-none">

                    <div class="flex flex-col items-center justify-center gap-2 mb-8">
                        <p class="m-0 text-[16px] font-semibold dark:text-white">
                            Login to your Account
                        </p>
                        <span class="m-0 text-xs max-w-[90%] text-center text-[#8B8E98]">
                            Get started with our app, just start section and enjoy experience.
                        </span>
                    </div>

                    <div class="w-full flex flex-col gap-2">
                        <label class="font-semibold text-xs text-gray-400" for="email">Email</label>
                        <input id="email"
                            class="border rounded-lg px-3 py-2 text-sm w-full outline-none dark:border-gray-500 dark:bg-gray-900 dark:text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Masukkan Email Anda" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 mb-2" />
                    </div>

                    <div class="w-full flex flex-col gap-2 mt-4">
                        <label class="font-semibold text-xs text-gray-400" for="password">Password</label>
                        <input id="password"
                            class="border rounded-lg px-3 py-2 text-sm w-full outline-none dark:border-gray-500 dark:bg-gray-900 dark:text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Masukkan Password" type="password" name="password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 mb-2" />
                    </div>

                    <div class="mt-6 w-full">
                        <button type="submit"
                            class="py-2 px-8 bg-blue-500 hover:bg-blue-800 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg cursor-pointer select-none">
                            Login
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="mt-4 text-center">
                            <a class="text-xs text-gray-400 hover:text-blue-500 underline"
                                href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </div>
                    @endif

                </div>
            </form>
    </div>
</x-guest-layout>
