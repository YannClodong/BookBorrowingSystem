@extends('layouts.main')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Borrow a book</h1>
    <div class="alert alert-danger d-flex" role="alert">
        <div class="d-flex align-items-center me-4">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 30px"></i>
        </div>
        <div>
            You have some book rental overdue. <br>
            <a class="" href="">Click here for more information.</a>
        </div>
    </div>
    <p class="lead">Here you can borrow a book among the <strong class="text-primary">{{$bookNo}}</strong> books, among the <strong class="text-primary">{{$genreNo}}</strong> genres in our library. <strong class="text-primary">{{$userNo}}</strong> users already trust us and are currently borrowing <strong class="text-primary">{{$borrowNo}}</strong> books.</p>
    <strong class="text-primary">Most borrowed books: </strong>
    <div class="d-flex mb-3">
        @foreach($borrows as $borrow)
        <a class="card bg-dark text-white me-2" style="max-width: 200px" href="{{route('books.show', $borrow->id)}}">
            <img src="{{$borrow->cover_image}}" class="card-img" alt="...">
        </a>
        @endforeach
    </div>

    <strong class="text-primary">Genres: </strong>
    <div class="d-flex mb-3">
        @foreach($genres as $g)
            <a class="badge bg-{{$g->style}} me-2" href="{{route('genres.show', $g->id)}}">{{$g->name}}</a>
        @endforeach
    </div>

    <strong class="text-primary">Recherche: </strong>
    <form action="{{route('books.index')}}" method="GET" class="row">
        <div class="col-12 mb-2">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control"
                    id="search"
                    name="q"
                    placeholder="Book title..."
                    value="{{ request()->query('q', '') }}"
                >
                <label for="search">Title, authors</label>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-lg btn-primary">Search</button>
        </div>
    </form>
    <hr class="my-4">


    <a class="btn btn-primary btn-lg" href="{{ route('books.index') }}" role="button">Explore the library</a>
</div>
@endsection
