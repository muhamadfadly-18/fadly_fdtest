<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Book::with('user');

        if ($request->filled('author')) {
            $query->where('author', 'ilike', '%' . $request->author . '%');
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }


        $books = $query->paginate(10);
        return view('books.index', compact('books'));
    }



    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',

        ]);

        $path = $request->file('thumbnail') ?
            $request->file('thumbnail')->store('thumbnails', 'public') : null;

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'thumbnail_path' => $path,

        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',

        ]);

        if ($request->hasFile('thumbnail')) {
            if ($book->thumbnail_path) {
                Storage::disk('public')->delete($book->thumbnail_path);
            }
            $book->thumbnail_path = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $book->update($request->only('title', 'author', 'description', 'rating'));

        return redirect()->route('books.index')->with('success', 'Buku diperbarui.');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        if ($book->thumbnail_path) {
            Storage::disk('public')->delete($book->thumbnail_path);
        }
        $book->delete();
        return back()->with('success', 'Buku dihapus.');
    }
    public function rateAndComment(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);

        // Update Rating
        $book->total_rating += $request->rating;
        $book->rating_count += 1;
        $book->rating = $book->total_rating / $book->rating_count;
        $book->save();

        // Simpan komentar (jika ada isi)
        if ($request->filled('content')) {
            $book->comments()->create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('books.show', $book->id)->with('success', 'Rating dan komentar berhasil dikirim!');
    }

    public function show($id)
    {
        $book = Book::with(['user', 'comments.user'])->findOrFail($id);
        $comments = $book->comments; // Tampilkan semua komentar, meskipun user-nya null
// dd($comments);

        return view('books.show', compact('book', 'comments'));
    }



}