@extends('layouts.main')

@section('content')
<div>
    <h1 class="display-4 text-primary">Recherche: </h1>
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
</div>
<hr class="mt-3 mb-4">

<div class="d-flex">
    @foreach($genres as $g)
        <a class="badge bg-{{$g->style}} me-2" href="{{route('genres.show', $g->id)}}">{{$g->name}}</a>
    @endforeach
</div>
<h3 class="display-6 text-primary">Results: </h3>
<div class="row" style="--bs-gutter-y: 1rem">
    @foreach($books as $book)
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="row g-0" style="margin: 0">
                    @if($book->cover_image != null)
                    <div style="width: auto">
                        <img class="rounded-left" src="{{ $book->cover_image }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    @endif
                    <div class="card-body" style="flex: 1; width: initial;">
                        <h5 class="card-title text-wrap-3 m-0">{{ $book->title }}</h5>
                        <p class="card-text m-0"><small class="text-muted m-0 mb-1">{{ $book->authors }}</small></p>
                        <p class="card-text text-wrap-3">{{ $book->description }}</p>
                        <p class="card-text"><small class="text-muted">Released date: {{ $book-> released_at }}</small></p>
                        <div class="d-flex">
                            <a class="btn btn-primary me-3" href="{{ route('books.show', [$book->id]) }}">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
