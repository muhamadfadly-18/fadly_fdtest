<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-700">
            👥 Daftar Pengguna
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filter -->
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <form method="GET" action="{{ route('users.index') }}"
                    class="flex flex-col md:flex-row md:items-end gap-4 flex-wrap">

                    <!-- Pencarian -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama / Email</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Contoh: fadly@mail.com"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Verifikasi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi</label>
                        <select name="verified"
                            class="border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring focus:ring-blue-300">
                            <option value="">Semua</option>
                            <option value="yes" {{ request('verified') == 'yes' ? 'selected' : '' }}>Terverifikasi
                            </option>
                            <option value="no" {{ request('verified') == 'no' ? 'selected' : '' }}>Belum Verifikasi
                            </option>
                        </select>
                    </div>

                    <!-- Tombol Filter -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-1 invisible">_</label>
                        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                            🔍 Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow overflow-x-auto">
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-blue-50 text-left uppercase text-xs font-semibold text-blue-700 border-b">
                        <tr>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Verifikasi</th>
                            <th class="px-6 py-3">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($users as $user)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($user->email_verified_at)
                                        <span
                                            class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                                            ✔ Terverifikasi
                                        </span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">
                                            ❌ Belum Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                    Tidak ada pengguna ditemukan 📭
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <!-- Pagination -->
            <div class="mt-6">
                {{ $users->withQueryString()->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
