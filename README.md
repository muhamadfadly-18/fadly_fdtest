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

```bash
git clone https://github.com/muhamadfadly-18/fadly_fdtest.git
cd fadly_fdtest
```

### 2. Install Dependensi

```bash
composer install
npm install && npm run dev
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
```

Lalu edit file `.env` dan sesuaikan konfigurasi database kamu:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=fan_inter
DB_USERNAME=postgres
DB_PASSWORD=180407
```

### 4. Generate APP Key dan Jalankan Migrasi

```bash
php artisan key:generate
php artisan migrate
```

### 5. Jalankan Aplikasi

```bash
php artisan serve
```

---

## 🔐 Fitur Utama

- Autentikasi:
  - Login, Register, Verifikasi Email, Lupa Password
- Manajemen Buku:
  - CRUD buku lengkap (judul, penulis, deskripsi, rating, thumbnail)
- Dashboard:
  - Menampilkan pengguna, pencarian, filter verifikasi email
- Landing Page:
  - Melihat daftar buku pengguna lain dengan filter & paginasi

---

## ✅ Testing

Jalankan testing dengan:

```bash
php artisan test
```

Pastikan kamu sudah membuat database untuk testing, misalnya:

```env
DB_DATABASE=fan_inter_test
```

Atau set di file `phpunit.xml`:

```xml
<php>
    <env name="APP_ENV" value="testing"/>
    <env name="DB_CONNECTION" value="pgsql"/>
    <env name="DB_DATABASE" value="fan_inter_test"/>
    <env name="DB_USERNAME" value="postgres"/>
    <env name="DB_PASSWORD" value="180407"/>
</php>
```

---

## 📁 Struktur Folder

```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Models/
resources/views/
routes/web.php
routes/api.php
tests/
```

---

## 📬 Kontak

Pengembang: **Muhamad Fadly**  
Email: [masukkan email kamu di sini kalau mau]  
GitHub: [https://github.com/muhamadfadly](https://github.com/muhamadfadly)
