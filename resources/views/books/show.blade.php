<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="max-w-5xl mx-auto py-10 px-4">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ url('/') }}"
                class="inline-flex items-center gap-2 text-sm text-blue-700 bg-blue-100 hover:bg-blue-200 hover:text-blue-800 px-4 py-2 rounded-md transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Buku
            </a>
        </div>



        <!-- Kontainer Utama -->
        <div class="bg-white p-8 rounded-2xl shadow-lg grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Thumbnail Buku -->
            <div>
                <img src="{{ asset('storage/' . $book->thumbnail_path) }}"
                    class="w-full h-96 object-cover rounded-lg shadow">
            </div>

            <!-- Informasi Buku -->
            <div class="flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $book->title }}</h1>
                    <p class="text-gray-700 mt-2 text-lg">Penulis: <span
                            class="font-semibold">{{ $book->author }}</span></p>
                    <p class="text-sm text-gray-500 mt-1">
                        Diunggah oleh: <span class="italic">{{ $book->user?->name ?? 'Tidak diketahui' }}</span><br>
                        🗓️ Pada: {{ \Carbon\Carbon::parse($book->created_at)->translatedFormat('d F Y') }}
                    </p>

                    <!-- Deskripsi -->
                    <p class="text-gray-700 mt-4 leading-relaxed">
                        <span class="font-semibold">Deskripsi:</span><br>
                        {{ $book->description ?? 'Tidak ada deskripsi.' }}
                    </p>

                    <!-- Rating Bintang -->
                    <div class="mt-4 flex items-center">
                        @php
                            $fullStars = floor($book->rating);
                            $halfStar = $book->rating - $fullStars >= 0.5;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp

                        @for ($i = 0; $i < $fullStars; $i++)
                            <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.431L24 9.587l-6 5.848
                                    1.417 8.251L12 18.896l-7.417 4.79L6 15.435
                                    0 9.587l8.332-1.569z" />
                            </svg>
                        @endfor

                        @if ($halfStar)
                            <svg class="w-6 h-6 text-yellow-400" viewBox="0 0 24 24">
                                <defs>
                                    <linearGradient id="half">
                                        <stop offset="50%" stop-color="currentColor" />
                                        <stop offset="50%" stop-color="transparent" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#half)" d="M12 .587l3.668 7.431L24 9.587l-6 5.848
                                    1.417 8.251L12 18.896l-7.417 4.79L6
                                    15.435 0 9.587l8.332-1.569z" />
                            </svg>
                        @endif

                        @for ($i = 0; $i < $emptyStars; $i++)
                            <svg class="w-6 h-6 text-gray-300 fill-current" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.431L24 9.587l-6 5.848
                                    1.417 8.251L12 18.896l-7.417 4.79L6
                                    15.435 0 9.587l8.332-1.569z" />
                            </svg>
                        @endfor

                        <span class="ml-2 text-gray-700 text-sm">{{ number_format($book->rating, 1) }}/5</span>
                    </div>
                </div>

                <!-- Form Rating & Komentar -->
                <div class="mt-6 space-y-4">
                    @auth
                        <form action="{{ route('books.rateAndComment', $book->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="rating" class="block text-sm text-gray-600 mb-1">Berikan Rating:</label>
                                <select name="rating" id="rating"
                                    class="w-32 border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <textarea name="content" rows="3"
                                    class="w-full border rounded-md p-3 focus:outline-none focus:ring focus:border-green-300"
                                    placeholder="Tulis komentar..."></textarea>
                            </div>

                            <button
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-md transition">
                                Kirim Rating & Komentar
                            </button>
                        </form>
                    @endauth

                    @guest
                        <div
                            class="relative border border-dashed border-gray-300 p-6 rounded-lg text-center bg-white/80 backdrop-blur-sm">
                            <p class="text-gray-500 text-sm mb-2">Silakan login terlebih dahulu untuk memberikan rating dan
                                komentar.</p>
                            <a href="{{ route('login') }}"
                                class="inline-block mt-2 px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                                🔐 Login Sekarang
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Komentar -->
        <div class="bg-white mt-10 p-6 rounded-2xl shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Komentar</h2>

            @if ($book->comments->isEmpty())
                <p class="text-gray-400 italic">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            @else
                <div class="space-y-4">
                    @foreach ($book->comments as $comment)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center font-semibold text-sm">
                                    {{ strtoupper(substr($comment->user?->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm">
                                        {{ $comment->user?->name ?? 'Anonim' }}</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</body>

</html>
