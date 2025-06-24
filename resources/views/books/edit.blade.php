<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Buku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1">Judul</label>
                        <input type="text" name="title" class="w-full border rounded px-3 py-2"
                            value="{{ old('title', $book->title) }}">
                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Penulis</label>
                        <input type="text" name="author" class="w-full border rounded px-3 py-2"
                            value="{{ old('author', $book->author) }}">
                        @error('author')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Deskripsi</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Thumbnail Saat Ini</label><br>
                        @if ($book->thumbnail_path)
                            <img src="{{ asset('storage/' . $book->thumbnail_path) }}"
                                class="w-32 h-32 object-cover mb-2 rounded">
                        @else
                            <span class="text-gray-400 italic">Tidak ada thumbnail</span>
                        @endif
                        <input type="file" name="thumbnail" class="w-full">
                        @error('thumbnail')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Rating</label>
                        <select name="rating"
                            class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500 cursor-not-allowed"
                            disabled>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ old('rating', $book->rating) == $i ? 'selected' : '' }}>
                                    {{ $i }} Bintang
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Update
                        </button>
                        <a href="{{ route('books.index') }}" class="text-gray-600 ml-4 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
