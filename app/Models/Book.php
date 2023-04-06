<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = "books";

    public function authors()
    {
        return $this->belongsToMany(Author::class, "authors_books", 'book_id', 'author_id');
    }
//
//    public function getAuthorName()
//    {
//        $authors = $this->author();
//        foreach ($authors as $author) {
//            dd($author->firstName);
//            $arr[] = $author->firstname;
//        };
//        return $arr;
//
//    }
}
