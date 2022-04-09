@extends('layouts.main')

@section("content")

    <div class="row">

        <div class="d-flex align-items-center">
            <h1 class="display-4 text-primary me-3 text-wrap-1 mb-0">{{ $book->title }}</h1>
            @can('update', $book)
                <a class="btn btn-outline-secondary me-2" href="{{ route('books.edit', [ $book->id ]) }}">
                    <i class="fa-solid fa-pencil"></i> Edit
                </a>
            @endcan
            @can('destroy', $book)
                <form action="{{ route('books.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">
                        <i class="fa-solid fa-trash-can"></i> Delete
                    </button>
                </form>
            @endcan
        </div>
        <div class="d-flex ps-4">
            @foreach($book->genres as $genre)
                <a class="badge bg-{{$genre->style}} me-2" href="{{route('genres.show', $genre->id)}}">{{$genre->name}}</a>
            @endforeach
        </div>
        <p class="lead ps-5 mb-3">Written by {{ $book->authors }}</p>

        @if($borrowed)
        <div class="card border-info mb-3 p-0">
            <div class="card-header w-100">Borrow "{{ $book->title }}"</div>
            <div class="card-body p-3">
                @if($deadline != null)
                    <div class="text-info display-6 mb-3"><i class="fa-solid fa-clock-rotate-left"></i> Deadline: {{ $deadline }}</div>
                    <p class="card-text">You borrowed this book, please return it back before the given date.</p>
                @else
                    <div class="text-info display-6 mb-3"><i class="fa-solid fa-clock-rotate-left"></i> You borrowed this book</div>
                    <p class="card-text">You borrowed this book, please return it back when you complete your reading.</p>
                @endif
            </div>
        </div>
        @endif

        @if(!$borrowed && $requested)
            <div class="card border-secondary mb-3 p-0">
                <div class="card-header w-100">Borrow "{{ $book->title }}"</div>
                <div class="card-body p-3">
                    <div class="text-secondary display-6 mb-3"><i class="fa-solid fa-clock-rotate-left"></i> You requested for this book.</div>
                    <p class="card-text">You posted a request for borrowing this book, we are currently processing it.</p>
                </div>
            </div>
        @endif

        @if($available && !$borrowed && !$requested)
        <div class="card border-success mb-3 p-0">
            <div class="card-header w-100">Borrow "{{ $book->title }}"</div>
            <div class="card-body p-3">
                <div class="text-success display-6 mb-3"><i class="fa-solid fa-check"></i> Available</div>
                @auth()
                <p class="card-text">The book is available please hit the button bellow to borrow it !</p>
                <form action="{{ route('borrows.store') }}" method="POST">
                    @csrf

                    <input type="hidden" id="book_id" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-primary me-3" style="font-size: 30px">Borrow</button>
                </form>
                @endauth
                @guest()
                    <p class="card-text">The book is available please hit the button bellow login in order to borrow it !</p>
                    <a href="{{ route('login') }}" type="submit" class="btn btn-primary me-3" style="font-size: 30px">Login</a>
                @endguest
            </div>
        </div>
        @endif

        @if(!$borrowed && !$available)
        <div class="card border-warning mb-3 p-0">
            <div class="card-header w-100">Borrow "{{ $book->title }}"</div>
            <div class="card-body p-3">
                @if($availabilityDate != null)
                    <div class="text-warning display-6 mb-3"><i class="fa-solid fa-xmark"></i> Available from the {{ $availabilityDate }}</div>
                @else
                    <div class="text-warning display-6 mb-3"><i class="fa-solid fa-xmark"></i> This book is currently unavailable.</div>
                @endif
                <p class="card-text">The book is not available please come back later to borrow it.</p>
{{--                <button class="btn btn-primary me-3" style="font-size: 30px">Borrow</button>--}}
            </div>
        </div>
        @endif
{{--        <div class="card border-danger mb-3 p-0">--}}
{{--            <div class="card-header w-100">Borrow "{{ $book->title }}"</div>--}}
{{--            <div class="card-body p-3">--}}
{{--                <div class="text-danger display-6 mb-3"><i class="fa-solid fa-xmark"></i> No longer available</div>--}}
{{--                <p class="card-text">We are sorry, but this book is no longer available in this library.</p>--}}
{{--                --}}{{--                <button class="btn btn-primary me-3" style="font-size: 30px">Borrow</button>--}}
{{--            </div>--}}
{{--        </div>--}}


        @can('update', $book)
        <div>
            <h3 class="display-6 text-primary">Management: </h3>

            <h6 class="h6 text-primary">Currently: </h6>
            @if(count($borrows) == 0)
                <span>Nothing here</span>
            @else
            <div class="accordion mb-3" id="accordionFlushExample">
                @foreach($borrows as $borrow)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="borrowed-accElem-{{$borrow->id}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#borrowed-collapse-{{$borrow->id}}" aria-expanded="false" aria-controls="borrowed-collapse-{{$borrow->id}}">
                            {{$borrow->reader->name}}
                        </button>
                    </h2>
                    <div id="borrowed-collapse-{{$borrow->id}}" class="accordion-collapse collapse" aria-labelledby="borrowed-accElem-{{$borrow->id}}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <strong>Borrowed by: </strong>{{$borrow->reader->name}}<br>
                            <strong>Borrowed from: </strong>{{$borrow->request_processed_at}}<br>
                            <strong>Rental deadline: </strong>{{$borrow->deadline ?? '-' }}<br>
                            <strong>Note: </strong> {{ $borrow->note ?? '-' }}<br>

                            <a class="mt-3 btn btn-outline-primary" href="{{route('borrows.show', $borrow->id)}}">
                                <i class="fa-solid fa-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <h6 class="h6 text-primary">Requests: </h6>
            @if(count($requests) == 0)
                <span>Nothing here</span>
            @else
            <div class="accordion mb-3" id="accordionFlushExample">
                @foreach($requests as $borrow)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="borrowed-accElem-{{$borrow->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#borrowed-collapse-{{$borrow->id}}" aria-expanded="false" aria-controls="borrowed-collapse-{{$borrow->id}}">
                                {{$borrow->reader->name}}
                            </button>
                        </h2>
                        <div id="borrowed-collapse-{{$borrow->id}}" class="accordion-collapse collapse" aria-labelledby="borrowed-accElem-{{$borrow->id}}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <strong>Requested by: </strong>{{$borrow->reader->name}}<br>
                                <strong>Request at: </strong>{{$borrow->created_at}}<br>
                                <strong>Note: </strong> {{ $borrow->note ?? '-' }}<br>

                                <a class="mt-3 btn btn-outline-primary" href="{{route('borrows.show', $borrow->id)}}">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
        @endcan

        <h3 class="display-6 text-primary">About the book: </h3>
        <div class="row">
            @if($book->cover_image != null)
            <div class="col-12 col-lg-3 d-flex align-items-start justify-content-center">
                <img style="width:200px;;float:left;margin-right:15px;margin-bottom:10px;"
                     src="{{ $book->cover_image }}"
                     class="img-fluid" alt="...">
            </div>
            @endif
            <div class="col-12 @if($book->cover_image != null) col-lg-9 @endif">
                <span class="h6 text-primary">Authors: </span>
                <p>{{ $book->authors }}</p>

                <span class="h6 text-primary">Number of pages: </span>
                <p>{{ $book->pages }}</p>

                <span class="h6 text-primary">Language: </span>
                <p>{{ $book->language_code }}</p>

                <span class="h6 text-primary">ISBN: </span>
                <p>{{ $book->isbn }}</p>


                <span class="h6 text-primary">Release date: </span>
                <p>{{ $book->released_at }}</p>

                @if($book->description != null)
                <span class="h6 text-primary">Description: </span>
                <p>
                    {{ $book->description }}
                </p>
                @endif

                <span class="h6 text-primary">Stocks: </span>
                <p>{{ $book->in_stock }}</p>

                <span class="h6 text-primary">Available: </span>
                <p>{{ $availableNumber }}</p>
            </div>
        </div>


    </div>

@endsection
