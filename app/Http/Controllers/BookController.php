<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
      $books = Book::with("authors")->get();
      return view("book.index",compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors =  Author::all();
        return view('book.create',compact("authors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request):RedirectResponse
    {

        $data = $request->validate($request->rules());
        $authors = $data["authors"];
        unset($data["authors"]);
        $book = Book::create($data);
        $book->authors()->sync($authors);
        return redirect()->route('book.show',['book' => $book->id])->with("success","product delete");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book):View
    {

        return view("book.show",compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book):View
    {
        return view("book.edit" ,compact("book"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validate($request->rules()));

        return redirect()->route('book.show',['book' => $book->id])->with("success","product delete");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('book.index')->with("success","product delete");
    }
}
