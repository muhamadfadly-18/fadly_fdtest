<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>📘 Book App</title>

    <!-- Logo di tab -->
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">

    <!-- Font & Style -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:400,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-white text-gray-800 font-[Poppins] min-h-screen flex flex-col">

    <!-- Navigation -->
    <header class="bg-white shadow-md py-5 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-blue-700 tracking-tight flex items-center gap-2">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-8 h-8"> Book App
            </h1>
            @if (Route::has('login'))
                <nav class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 shadow-md transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-700 font-semibold hover:underline">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-blue-700 font-semibold hover:underline">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow py-16 fade-in">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Judul -->
            <h2 class="text-4xl font-extrabold text-center text-blue-800 mb-12 tracking-tight">
                📚 Koleksi Buku Terbaru
            </h2>

            <!-- Filter -->
            <form method="GET" action="{{ url('/') }}"
                class="mb-14 bg-white shadow-sm rounded-xl px-6 py-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Author -->
                <div class="flex flex-col w-full md:w-1/3">
                    <label for="author" class="text-sm font-medium text-gray-700 mb-1">Filter Penulis</label>
                    <select name="author" id="author"
                        class="rounded-lg border-gray-300 text-sm py-2 px-4 shadow-sm focus:ring-2 focus:ring-blue-400">
                        <option value="">Semua Penulis</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author }}" {{ request('author') == $author ? 'selected' : '' }}>
                                {{ $author }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Rating -->
                <div class="flex flex-col w-full md:w-1/3">
                    <label for="min_rating" class="text-sm font-medium text-gray-700 mb-1">Minimal Rating</label>
                    <select name="min_rating" id="min_rating"
                        class="rounded-lg border-gray-300 text-sm py-2 px-4 shadow-sm focus:ring-2 focus:ring-blue-400">
                        <option value="">Semua Rating</option>
                        <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>4+ ⭐</option>
                        <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>3+ ⭐</option>
                        <option value="2" {{ request('min_rating') == '2' ? 'selected' : '' }}>2+ ⭐</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="w-full md:w-1/3 flex items-end justify-end">
                    <button type="submit"
                        class="mt-4 md:mt-0 bg-blue-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow hover:bg-blue-700 transition">
                        Filter 📖
                    </button>
                </div>
            </form>

            <!-- List Buku -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse ($books as $book)
                    <a href="{{ route('books.show', $book->id) }}"
                        class="bg-white p-5 rounded-2xl shadow-md hover:shadow-xl transform hover:scale-[1.03] transition duration-300 block group">
                        @if ($book->thumbnail_path)
                            <img src="{{ asset('storage/' . $book->thumbnail_path) }}"
                                class="w-full h-52 object-cover rounded-xl mb-4 group-hover:opacity-90 transition">
                        @else
                            <div
                                class="w-full h-52 bg-gray-100 flex items-center justify-center rounded-xl mb-4 text-gray-400 italic">
                                Tidak ada gambar
                            </div>
                        @endif

                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition">
                            {{ $book->title }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">✍️ Penulis: <span
                                class="font-medium">{{ $book->author }}</span></p>
                        <p class="text-sm text-yellow-500 mt-1">⭐ {{ $book->rating }}</p>
                        <p class="text-xs text-gray-400 mt-2 italic">
                            📤 Diunggah oleh {{ $book->user->name }} <br>
                            🗓️ {{ \Carbon\Carbon::parse($book->created_at)->format('d M Y') }}
                        </p>

                    </a>
                @empty
                    <p class="col-span-3 text-center text-gray-500 text-lg">Belum ada buku yang diunggah 😔</p>
                @endforelse
            </div>
        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-white border-t mt-20 py-6">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm text-gray-500">
            &copy; {{ now()->year }} <span class="font-semibold text-blue-600">Book App</span> — Dibuat dengan <span
                class="text-red-500">❤️</span> dan <span class="text-yellow-500">Muhamad Fadly</span>
        </div>
    </footer>

</body>

</html>
