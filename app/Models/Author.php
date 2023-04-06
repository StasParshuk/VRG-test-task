<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = "authors";

    private ?int $id;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $father_name;
    private  $created_at;
    private  $updated_at;

    public function books()
    {
       return $this->belongsToMany(Book::class,"authors_books",'author_id','book_id')->get();
    }
}
