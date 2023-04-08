@extends('layouts.main')


@section('content')

<div class="container mt-xl-4 ">
    <h1 class="text-center" >create book</h1>
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Create Book
        </div>
        <div class="card-body">
            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{route('book.store')}}">
                @csrf


                <div class="form-group">
                    <label for="exampleInputEmail1">Book Name</label>
                    <input type="text" id="name" name="name" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" class="form-control" required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Book image</label>
                    <input type="text" id="image" name="image" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Author</label>
                    <select name="authors"  class="form-control"  title="Author" size="2" multiple>
                        @foreach($authors as $author)
                            <option value="{{$author->id }}">{{ $author->first_name}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>



@endsection

