@extends('layouts.main')


@section('content')
    <h1> Author Index</h1>
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
                    ADD NEW Author
                </button>
            </div>
        </div>
        <div>
            <table class="table table-inverse">
                <thead>
                <tr>

                    <th>@sortablelink('id')</th>
                    <th>@sortablelink('first_name')</th>
                    <th>@sortablelink('last_surname')</th>
                    <th>@sortablelink('father_name')</th>
                    <th>@sortablelink('created_at')</th>
                    <th>@sortablelink('updated_at')</th>
                    <th>book</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody id="todos-list" name="todos-list">
                @if($authors === null)

                    <tr>
                        <td colspan="4">no records found</td>
                    </tr>
                @endif
                @foreach($authors as $author)
                    <tr id="author{{$author->id}}">
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
                        <td>

                            <a href="{{ route('author.show', ['author' => $author->id]) }}">show</a>
                            <a href="{{ route('author.edit', ['author' => $author->id]) }}">edit</a>
                            <a class="delete-button"  id="{{$author->id}}">delete</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $authors->appends(\Request::except('page'))->render() !!}
            </div>



            <div class="modal fade" id="formModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Create Author</h4>
                        </div>
                        <div class="modal-body">
                            <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Surname</label>
                                    <input type="text" id="last_surname" name="last_surname" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Father Name</label>
                                    <input type="text" id="father_name" name="father_name" class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Book</label>
                                    <select name="book" id="book" class="form-control" title="Authors">
                                        @foreach($allBooks as $book)
                                            <option value="{{$book->id }}">{{ $book->name}}</option>
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
    <script src="{{asset("ajax-forma/js/authorJQ.js")}}"></script>
@endsection

