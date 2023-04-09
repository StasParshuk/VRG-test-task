<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory,Sortable;

    protected $guarded = false;
    protected $table = "books";

    public $sortable = ['id', 'name', 'description', 'created_at', 'updated_at'];

    private ?int $id;
    private ?string $name;
    private ?string $description;
    private  $created_at;
    private  $updated_at;

    public function authors()
    {
        return $this->belongsToMany(Author::class, "authors_books", 'book_id', 'author_id');
    }
}
