<section class="space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-red-600 flex items-center gap-2">
            🗑️ {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Setelah akun Anda dihapus, semua data dan sumber daya akan terhapus secara permanen. Harap unduh atau simpan data penting Anda sebelum melanjutkan.') }}
        </p>
    </header>

    <x-danger-button
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 transition"
    >
        {{ __('Hapus Akun') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-800">
                ⚠️ {{ __('Anda yakin ingin menghapus akun?') }}
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                {{ __('Setelah akun dihapus, semua data akan hilang selamanya. Masukkan kata sandi Anda untuk konfirmasi.') }}
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="{{ __('Password') }}" class="text-sm text-gray-700" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-red-300"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-500" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2">
                    ✖️ {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="px-4 py-2 bg-red-600 hover:bg-red-700 transition">
                    🗑️ {{ __('Ya, Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
