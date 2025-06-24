<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-700">
            👤 Profil Pengguna
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-blue-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Update Informasi Profil -->
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">📝 Perbarui Informasi Profil</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">🔒 Ganti Password</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="bg-white shadow-md rounded-xl p-6 border border-red-200">
                <h3 class="text-lg font-semibold text-red-600 mb-4 border-b pb-2">⚠️ Hapus Akun</h3>
                <p class="text-sm text-red-500 mb-4">
                    Tindakan ini tidak dapat dibatalkan. Harap pastikan sebelum melanjutkan.
                </p>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
