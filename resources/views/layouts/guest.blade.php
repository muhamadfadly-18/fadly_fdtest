<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BookApp') }}</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .image-3d {
            perspective: 1000px;
        }

        .image-3d-inner {
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .image-3d:hover .image-3d-inner {
            transform: rotateY(-10deg) scale(1.05);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-100 to-blue-200 text-gray-900 min-h-screen flex items-center justify-center p-6">

    <div class="absolute top-6 left-6">
        <a href="{{ url('/') }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium bg-white px-4 py-2 rounded-full shadow transition duration-200">
            ← Kembali ke Beranda
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-10 w-full max-w-6xl items-center">
        <!-- Gambar Orang 3D -->
        <div class="image-3d flex justify-center">
            <div class="image-3d-inner">
                <img src="{{ asset('image/perpus.png') }}" alt="Orang" class="h-[400px] object-contain drop-shadow-xl">
            </div>
        </div>

        <!-- Kartu Form Login -->
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full">
            {{ $slot }}
        </div>
    </div>

</body>


</html>
