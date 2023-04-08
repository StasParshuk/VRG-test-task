@extends('layouts.main')


@section('content')
<h1>Category index</h1>
<a href="{{ route('book.create')}}">Create New Book</a>
<table class="table col-12">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>image</th>
        <th>createdAt</th>
        <th>updatedAt</th>
        <th>authors</th>
        <th>action</th>
    </tr>
    </thead>
    <tbody>
    @if($books === null)

        <tr>
            <td colspan="4">no records found</td>
        </tr>
    @endif

    @foreach($books as $book)
    <tr>
        <td>{{ $book->id }}</td>
        <td>{{ $book->name }}</td>
        <td>{{ $book->image }}</td>
        <td>{{ $book->created_at }}</td>
        <td>{{ $book->updated_at }}</td>
        <td>
            @foreach($book->authors as $author)
            {{ $author->first_name . $author->last_name . $author->father_name}}
            @endforeach
        </td>
        <td>

            <a href="{{ route('book.show', ['book' => $book->id]) }}">show</a>
        </td>
    </tr>

    @endforeach
    </tbody>
</table>
@endsection

