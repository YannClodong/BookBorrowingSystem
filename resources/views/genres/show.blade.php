@extends('layouts.main')

@section('content')
    <div>
        <div class="d-flex mb-3">
            @foreach($genres as $g)
                <a class="badge bg-{{$g->style}} me-2" href="{{route('genres.show', $g->id)}}">{{$g->name}}</a>
            @endforeach
        </div>
        <h1 class="display-4 text-primary">Result in the {{ $genre->name }} genre: </h1>
        <div class="row" style="--bs-gutter-y: 1rem">
            @foreach($genre->books as $book)
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="row g-0" style="margin: 0">
                            @if($book->cover_image != null)
                                <div style="width: auto">
                                    <img class="rounded-left" src="{{ $book->cover_image }}"
                                         class="img-fluid rounded-start" alt="...">
                                </div>
                            @endif
                            <div class="card-body" style="flex: 1; width: initial;">
                                <h5 class="card-title text-wrap-3">{{ $book->title }}</h5>
                                <p class="card-text text-wrap-3">{{ $book->description }}</p>
                                <p class="card-text"><small class="text-muted">Released
                                        date: {{ $book-> released_at }}</small></p>
                                <div class="d-flex">
                                    <a class="btn btn-primary me-3" href="{{ route('books.show', [$book->id]) }}">View
                                        more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
