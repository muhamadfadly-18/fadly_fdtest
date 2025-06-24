<section class="space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-blue-700 flex items-center gap-2">
            👤 {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Perbarui nama dan alamat email akun Anda.') }}
        </p>
    </header>

    <!-- Form Kirim Verifikasi -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form Update Profil -->
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-5 mt-6">
        @csrf
        @method('patch')

        <!-- Nama -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />

            <!-- Verifikasi Email -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-700">
                    <p>
                        📧 {{ __('Alamat email Anda belum diverifikasi.') }}
                        <button
                            form="send-verification"
                            class="underline text-blue-600 hover:text-blue-800 font-medium ml-1"
                        >
                            {{ __('Kirim ulang link verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-green-600">
                            ✅ {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 transition">
                💾 {{ __('Simpan') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >
                    ✅ {{ __('Profil berhasil diperbarui.') }}
                </p>
            @endif
        </div>
    </form>
</section>
