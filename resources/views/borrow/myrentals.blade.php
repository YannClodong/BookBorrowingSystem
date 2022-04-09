@extends('layouts.main')

@section('content')
    <h1 class="display-4 mb-3">My borrows: </h1>
    @foreach($borrows as $borrow)
        <ul class="list-group">
            <a class="list-group-item list-group-item-action {{ $borrow->deadline != null && $borrow->status == \App\Models\BorrowStatus::ACCEPTED->value && $borrow->deadline < now() ? "list-group-item-danger" : ""  }}"
               href="{{route('borrows.show', $borrow->id)}}">
                <div class="d-flex justify-between">
                    <div>
                        <strong>{{ $borrow->book->title }}</strong><br>
                        <small>Authors: {{ $borrow->book->authors }} - Date: {{ $borrow->created_at }} - Deadline: {{ $borrow->deadline ?? '/' }}</small>
                    </div>
                    <div>
                        @if($borrow->status == \App\Models\BorrowStatus::PENDING->value)
                            <span class="badge bg-secondary">Requested</span>
                        @elseif($borrow->status == \App\Models\BorrowStatus::REJECTED->value)
                            <span class="badge bg-warning">Rejected</span>
                        @elseif($borrow->status == \App\Models\BorrowStatus::ACCEPTED->value)
                            @if($borrow->deadline == null || $borrow->deadline < now())
                                <span class="badge bg-success">Accepted</span>
                            @else
                                <span class="badge bg-danger">Overdue</span>
                            @endif
                        @elseif($borrow->status == \App\Models\BorrowStatus::RETURNED->value)
                            <span class="badge bg-dark">Returned</span>
                        @endif
                    </div>
                </div>

            </a>
        </ul>
    @endforeach
@endsection
