<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function books(): void
    {
        $this->belongsToMany(Book::class,"authors_books",'author_id','book_id');
    }
}
