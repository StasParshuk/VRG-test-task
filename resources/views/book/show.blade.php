@extends('layouts.main')


@section('content')
<h1>book show</h1>

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
    @if($book === null)

        <tr>
            <td colspan="4">no records found</td>
        </tr>
    @endif
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
            <a href="{{ route('book.edit', ['book' => $book->id]) }}">edit</a>
{{--            <a href="{{ route('book.index') }}">back</a>--}}
        </td>
    </tr>

    </tbody>
</table>
@endsection
{{--<a href="{{ path('app_category_new') }}">Create new</a>--}}

