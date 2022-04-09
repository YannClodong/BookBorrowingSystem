@extends('layouts.main')

@section('content')
    <h1 class="display-4 mb-3">Requests: </h1>
    <ul class="list-group">
        @if(count($borrows) > 0)
            @foreach($borrows as $borrow)
                <a class="list-group-item list-group-item-action d-flex justify-between" href="{{route('borrows.show', $borrow->id)}}">
                    <div>
                        <strong>{{ $borrow->reader->name }}</strong>
                        {{ $borrow->book->title }}
                    </div>
                    <span class="badge bg-secondary rounded-pill px-2">{{ $borrow["status"] }}</span>
                </a>
            @endforeach
        @else
            <li class="list-group-item d-flex justify-between">
                There is nothing here
            </li>
        @endif
    </ul>
@endsection
