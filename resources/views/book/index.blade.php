@extends('layouts.main')


@section('content')
    <h1>Book index</h1>
    <div class="container">
        <div class="d-flex bd-highlight mb-4">

            <div class="p-2 flex-shrink-0 bd-highlight">
                <form class="form-inline" method="GET">
                    <div class="form-group mb-2">
                        <label for="filter" class="col-sm-2 col-form-label">Filter Name</label>
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Product name...">
                    </div>
                    <button type="submit" class="btn btn-success mb-2">Filter</button>
                </form>
            </div>

            <div class="p-2 flex-shrink-0 bd-highlight">
                <button class="btn btn-success" id="btn-add">
                    ADD NEW BOOK
                </button>
            </div>
        </div>
        <div>
            <table class="table table-inverse">
                <thead>
                <tr>
                    <th>@sortablelink('id')</th>
                    <th>@sortablelink('name')</th>
                    <th>@sortablelink('description')</th>
                    <th>image</th>
                    <th>@sortablelink('created_at')</th>
                    <th>@sortablelink('updated_at')</th>
                    <th>authors</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody id="todos-list" name="todos-list">
                @if($books === null)

                    <tr>
                        <td colspan="4">no records found</td>
                    </tr>
                @endif
                @foreach($books as $book)
                    <tr id="book{{$book->id}}">
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->description }}</td>
                        <td><img src="{{asset('storage') . '/' . $book->image }}" class="img-fluid" width="200px" height="200px" alt="no found"></td>
                        <td>{{ $book->created_at }}</td>
                        <td>{{ $book->updated_at }}</td>
                        <td>
                            @foreach($book->authors as $author)
                                {{ $author->first_name . $author->last_name . $author->father_name}}
                            @endforeach
                        </td>
                        <td>

                            <a href="{{ route('book.show', ['book' => $book->id]) }}">show</a>
                            <a href="{{ route('book.edit', ['book' => $book->id]) }}">edit</a>
                            <a class="delete-button"  id="{{$book->id}} " href="#">delete</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $books->appends(\Request::except('page'))->render() !!}
            </div>

            <div class= "modal fade" id="formModal"aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Create Todo</h4>
                        </div>
                        <div class="modal-body">
                            <form id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Book Name</label>
                                    <input type="text" id="name" name="name" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea name="description" id="description" class="form-control"
                                              required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Book image</label>
                                    <input type="file" id="image" name="image" class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Author</label>
                                    <select name="authors" id="authors" class="form-control" title="Authors">
                                        @foreach($allAuthors as $author)
                                            <option value="{{$author->id }}">{{ $author->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                            </button>
                            <input type="hidden" id="todo_id" name="todo_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset("ajax-forma/js/bookJQ.js")}}"></script>
@endsection

