@extends('layouts.main')


@section('content')
<h1>book show</h1>

<table class="table col-12">
    <thead>
    <tr>
        <th>Id</th>
        <th>first_name</th>
        <th>last_name</th>
        <th>father_name</th>
        <th>createdAt</th>
        <th>updatedAt</th>
    </tr>
    </thead>
    <tbody>
    @if($author === null)

        <tr>
            <td colspan="4">no records found</td>
        </tr>
    @endif
    <tr>
        <td>{{ $author->id }}</td>
        <td>{{ $author->first_name }}</td>
        <td>{{ $author->last_surname }}</td>
        <td>{{ $author->father_name }}</td>
        <td>{{ $author->created_at }}</td>
        <td>{{ $author->updated_at }}</td>
        <td>
            @foreach($author->books as $book)
                {{ $book->name}}
            @endforeach
        </td>
    </tr>

    </tbody>
</table>
@endsection

