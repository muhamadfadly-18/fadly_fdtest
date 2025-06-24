<section class="space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-blue-700 flex items-center gap-2">
            🔐 {{ __('Perbarui Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Gunakan password yang panjang dan acak untuk menjaga keamanan akun Anda.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4 space-y-5">
        @csrf
        @method('put')

        <!-- Password Saat Ini -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" />
            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300"
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password Baru -->
        <div>
            <x-input-label for="update_password_password" :value="__('Password Baru')" />
            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password Baru')" />
            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Tombol Simpan -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 transition">
                💾 {{ __('Simpan') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600"
                >
                    ✅ {{ __('Password berhasil diperbarui.') }}
                </p>
            @endif
        </div>
    </form>
</section>
