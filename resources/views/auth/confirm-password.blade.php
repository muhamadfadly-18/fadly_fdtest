<x-guest-layout>
    <div class="max-w-md mx-auto mt-20 bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-xl font-bold text-blue-700 mb-2">🔐 Konfirmasi Password</h2>

        <p class="text-sm text-gray-600 leading-relaxed mb-6">
            Ini adalah area yang aman dalam aplikasi. Silakan masukkan password Anda untuk melanjutkan.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Tombol -->
            <div class="flex justify-end">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 transition">
                    ✅ Konfirmasi
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
