<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authors_books', function (Blueprint $table) {

            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('author_id');
            $table->foreign('book_id')->on('books')->references('id')->onDelete('cascade');
            $table->foreign('author_id')->on('authors')->references('id')->onDelete('cascade');
            $table->index('book_id','author_book_book_fk');
            $table->index('author_id','author_book_author_fk');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors_books');
    }
};
