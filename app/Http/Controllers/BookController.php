<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Services\ImageSaveService;
use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Book $book,Request $request):View
    {

        $allAuthors = Author::all();

        if (!empty($request->query('filter')  )){
           $books = $book->sortable()->where('name', 'like', '%'.$request->query('filter').'%')->paginate(15);
        }else{
            $books = $book->sortable()->with("authors")->paginate(15);
        }


        return view("book.index", compact('books', 'allAuthors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validate($request->rules());
        $authors = $data["author"];
        unset($data["author"]);

        $data['image'] = ImageSaveService::saveImage($request->file('image' ), 'book' , 'public');
        $book = Book::create($data);
        $book->authors()->sync($authors);
        $authors = $book->authors;
        return Response::json($book);
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
    public function destroy(Book $book):JsonResponse
    {
        $book->delete();
        return Response::json('success');
    }
}
