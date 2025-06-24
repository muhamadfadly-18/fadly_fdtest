# 📚 Laravel FDTest - Muhamad Fadly

FDTest adalah aplikasi manajemen buku dan pengguna berbasis Laravel. Aplikasi ini menerapkan praktik terbaik dalam pengembangan perangkat lunak, seperti struktur kode yang bersih, prinsip SOLID, penanganan error, dan fitur autentikasi serta CRUD yang lengkap.

---

## 🔧 Teknologi yang Digunakan

- Laravel (Blade, Inertia JS, atau Livewire)  
- PostgreSQL  
- Tailwind CSS  
- Laravel Breeze / Jetstream (untuk autentikasi)  
- PHPUnit (untuk testing)

---

## 🚀 Langkah Instalasi

### 1. Clone Repository

git clone https://github.com/muhamadfadly-18/fadly_fdtest.git
cd fadly_fdtest


### 2. Install Dependensi
- composer install
- npm install && npm run dev

### 3. Konfigurasi Environment

cp .env.example .env

### 4. Generate APP Key & Migrasi Database

-php artisan key:generate
-php artisan migrate
 
### 5. Jalankan Aplikasi

php artisan serve



🔐 Fitur Utama
- Login menggunakan email dan password
- Registrasi akun baru
- Reset password melalui email
- Verifikasi email pengguna
- Ubah password dari halaman profil
- Menampilkan nama pengguna dan status verifikasi
- CRUD Buku (judul, penulis, deskripsi, thumbnail, rating 1–5)
- Guest bisa melihat daftar buku yang diunggah pengguna lain
- Filter buku berdasarkan penulis, tanggal upload, dan rating
- Fitur pencarian dan paginasi
- Daftar pengguna + filter status verifikasi email

📁 Struktur Folder Penting
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Models/
resources/views/
routes/web.php
routes/api.php

