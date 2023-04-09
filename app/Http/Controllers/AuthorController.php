<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Response;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Author $author,Request $request):View
    {

        $allBooks = Book::all();

        if (!empty($request->query('filter')  )){
           $authors = $author->sortable()->where('first_name', 'like', '%'.$request->query('filter').'%')->paginate(15);
        }else{
            $authors = $author->sortable()->with("books")->paginate(15);
        }

        return view("author.index", compact('authors', 'allBooks'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validate($request->rules());
        $books = $data["book"];
        unset($data["book"]);
        $author = Author::create($data);
        $author->books()->sync($books);
        $books = $author->books;
        return Response::json($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author):View
    {

        return view("author.show",compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author):View
    {
        return view("author.edit" ,compact("author"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author): RedirectResponse
    {
        $author->update($request->validate($request->rules()));

        return redirect()->route('book.show',['book' => $author->id])->with("success","product delete");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): JsonResponse
    {
        $author->delete();
        return Response::json('success');
    }
}
