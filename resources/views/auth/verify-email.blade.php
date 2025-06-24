<x-guest-layout>
    <div class="max-w-md mx-auto mt-16 bg-white p-8 rounded-xl shadow-lg text-center">
        <h2 class="text-2xl font-bold text-blue-700 mb-2">📧 Verifikasi Email</h2>
        <p class="text-sm text-gray-600 leading-relaxed mb-6">
            Silakan verifikasi alamat email Anda dengan mengklik link yang telah kami kirimkan ke email Anda.<br>
            Jika Anda belum menerima email tersebut, kami bisa mengirimkannya kembali.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 border border-green-300 rounded p-3">
                ✅ Link verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <div class="mt-6 flex flex-col sm:flex-row sm:justify-center sm:items-center gap-4">
            <!-- Kirim Ulang -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 transition">
                    🔁 Kirim Ulang Email
                </x-primary-button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    🚪 Keluar
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
