<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

// Landing page
// Di web.php (route sudah ada)
Route::get('/', function () {
    $query = Book::with('user')->latest();

    if (request()->filled('author')) {
        $query->where('author', request('author'));
    }

    if (request()->filled('min_rating')) {
        $query->where('rating', '>=', request('min_rating'));
    }

    $books = $query->take(10)->get();

    // Kirim daftar penulis unik untuk dropdown
    $authors = \App\Models\Book::select('author')->distinct()->pluck('author');

    return view('landing', compact('books', 'authors'));
});


// Route untuk komentar & rating buku (publik)
Route::post('/books/{id}/rate-comment', [BookController::class, 'rateAndComment'])->name('books.rateAndComment');

// Route yang butuh login + verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Route resource manual
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});


Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

require __DIR__ . '/auth.php';
