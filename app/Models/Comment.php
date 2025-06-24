<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class Comment extends Model
{
    protected $fillable = [
    'user_id',
    'content',
    'book_id', // kalau kamu menyertakan ini secara manual juga bisa dimasukkan
];

public function book()
{
    return $this->belongsTo(Book::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
