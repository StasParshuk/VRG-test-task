<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kyslik\ColumnSortable\Sortable;

class Author extends Model
{
    use HasFactory,Sortable;

    protected $guarded = false;
    protected $table = "authors";

    public $sortable = ['id', 'first_name', 'last_surname', 'father_name', 'created_at', 'updated_at'];
    private ?int $id;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $father_name;
    private  $created_at;
    private  $updated_at;

    public function books()
    {
       return $this->belongsToMany(Book::class,"authors_books",'author_id','book_id');
    }
    public function fullName():string
    {
       return $this->first_name . $this->last_name . $this->father_name ;
    }
}
