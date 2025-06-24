<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-700 flex items-center gap-2">
            📚 Daftar Buku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filter & Tambah Buku -->
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <form method="GET" action="{{ route('books.index') }}"
                    class="flex flex-col md:flex-row md:items-end gap-4 flex-wrap">

                    <!-- Filter Penulis -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Filter Penulis</label>
                        <input type="text" name="author" placeholder="Nama Penulis" value="{{ request('author') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Rating -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                        <select name="rating"
                            class="border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring focus:ring-blue-300">
                            <option value="">Semua</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                    {{ $i }} bintang
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Tombol Filter -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-1 invisible">.</label>
                        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                            🔍 Filter
                        </button>
                    </div>

                    <!-- Tombol Tambah Buku -->
                    <div class="ml-auto">
                        <label class="block text-sm font-medium text-white mb-1 invisible">.</label>
                        <a href="{{ route('books.create') }}"
                            class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">
                            + Tambah Buku
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabel Buku -->
            <div class="bg-white rounded-xl shadow overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-50 text-left uppercase text-xs font-semibold text-blue-700 border-b">
                        <tr>
                            <th class="px-5 py-3">Judul</th>
                            <th class="px-5 py-3">Penulis</th>
                            <th class="px-5 py-3">Rating</th>
                            <th class="px-5 py-3">Gambar</th>
                            <th class="px-5 py-3">Tanggal</th>
                            <th class="px-5 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @forelse ($books as $book)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-5 py-3 font-medium">{{ $book->title }}</td>
                                <td class="px-5 py-3">{{ $book->author }}</td>
                                <td class="px-5 py-3">
                                    <span
                                        class="inline-block bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold">
                                        ⭐ {{ $book->rating }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    @if ($book->thumbnail_path)
                                        <img src="{{ asset('storage/' . $book->thumbnail_path) }}"
                                            class="w-14 h-14 object-cover rounded shadow">
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3">{{ $book->created_at->format('d M Y') }}</td>
                                <td class="px-5 py-3 space-x-2">
                                    @can('update', $book)
                                        <a href="{{ route('books.edit', $book) }}"
                                            class="inline-flex items-center gap-1 bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600 transition">
                                            ✏️ Edit
                                        </a>
                                    @endcan

                                    @can('delete', $book)
                                        <form action="{{ route('books.destroy', $book) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus buku ini?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="inline-flex items-center gap-1 bg-red-500 text-white text-xs px-3 py-1 rounded hover:bg-red-600 transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    @endcan

                                    @cannot('update', $book)
                                        @cannot('delete', $book)
                                            <span class="text-gray-400 italic text-xs">🚫 Tidak punya akses</span>
                                        @endcannot
                                    @endcannot
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-6 text-center text-gray-500 text-sm">
                                    📭 Tidak ada data buku ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
