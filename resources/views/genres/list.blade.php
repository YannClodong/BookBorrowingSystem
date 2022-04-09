@extends('layouts.main')

@section('content')
    <h1 class="display-4 mb-3">Genres: </h1>
    <ul class="list-group">
        @foreach($genres as $genre)
            <a class="list-group-item list-group-item-{{ $genre->style }}"
                href="{{ route('genres.edit', [ 'genre' => $genre->id ]) }}">
                {{ $genre->name }}
            </a>
        @endforeach
        <a class="list-group-item list-group-item-action d-flex align-items-center justify-center" href="{{ route('genres.create') }}">
            <i class="fa-solid fa-plus me-2"></i>Create a new genre
        </a>
    </ul>
@endsection
