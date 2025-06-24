<x-guest-layout>
    <div class="max-w-md mx-auto mt-24 bg-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-bold text-blue-700 mb-4 text-center">🔑 Lupa Password</h2>

        <p class="text-sm text-gray-600 leading-relaxed text-center mb-6">
            Tidak masalah! Masukkan email Anda, kami akan mengirimkan link untuk mengatur ulang password Anda.
        </p>

        <!-- Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Tombol -->
            <div class="flex justify-between items-center mt-6">
                <!-- Tombol Kembali -->
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-200 transition">
                    ← Kembali
                </a>

                <!-- Tombol Kirim -->
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow hover:bg-blue-700 transition">
                    📧 Kirim Link Reset
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
