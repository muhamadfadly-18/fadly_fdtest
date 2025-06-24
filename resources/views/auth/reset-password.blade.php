<x-guest-layout>
    <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-blue-700 mb-1 text-center">🔒 Reset Password</h2>
        <p class="text-sm text-gray-500 mb-6 text-center">
            Silakan isi email dan password baru untuk mengatur ulang akun Anda.
        </p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token Reset -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password Baru')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Tombol Reset -->
            <div class="flex justify-end">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 transition">
                    🔄 {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
