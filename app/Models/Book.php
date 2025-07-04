<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;


class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'author', 'description', 'thumbnail_path', 'rating'
    ];

       public function user()
{
    return $this->belongsTo(User::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

}
