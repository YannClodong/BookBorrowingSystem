@extends('layouts.main')

@section('content')

    <h1 class="display-4 mb-4 text-primary">Details: </h1>

    @if($borrow->status == \App\Models\BorrowStatus::ACCEPTED->value &&
        $borrow->deadline != null && $borrow->deadline < now())
        <div class="alert alert-danger" role="alert">
            This rental is overdue, please bring the book to the library as soon as possible.
        </div>
    @endif
    <table class="table">
        <tbody>
        <tr>
            <th>Reader</th>
            <td>{{ $borrow->reader->name }} ({{ $borrow->reader->id }})</td>
        </tr>
        <tr>
            <th>Book</th>
            <td><a href="{{route('books.show', $borrow->book->id)}}">{{ $borrow->book->title }} ({{ $borrow->book->id }})</a></td>
        </tr>
        <tr>
            <th>Authors</th>
            <td>{{ $borrow->book->authors }}</td>
        </tr>
        <tr>
            <th>Release date</th>
            <td>{{ $borrow->book->released_at }}</td>
        </tr>
        <tr>
            <th>Rental date</th>
            <td>{{ $borrow->created_at }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{$borrow->status}}</td>
        </tr>
        @if($borrow->managedBy != null)
            @can('librarian')
                <tr>
                    <th>Processed by</th>
                    <td>{{$borrow->managedBy->name}} at {{$borrow->request_processed_at}}</td>
                </tr>
            @endcan
            <tr>
                <th>Deadline</th>
                <td>
                    @if($borrow->status == \App\Models\BorrowStatus::ACCEPTED->value)
                        @can('librarian')
                            <form class="d-flex" action="{{route('borrows.deadline', $borrow->id)}}" method="POST">
                                @csrf
                                <input type="date" class="form-control me-3" style="width: initial;" id="deadline"
                                       name="deadline" placeholder="deadline" value="{{$borrow->deadline}}">
                                <label for="deadline" hidden="true">Deadline</label>
                                <button type="submit" class="btn btn-outline-primary">Save</button>
                            </form>
                        @endcan
                        @cannot('librarian')
                            <span>{{$borrow->deadline ?? '-'}}</span>
                        @endcannot
                    @else
                        {{$borrow->deadline ?? '-'}}
                    @endif
                </td>
            </tr>
        @endif


        @can('librarian')
            @if($borrow->returnManagedBy != null)
                <tr>
                    <th>Return managed by</th>
                    <td>{{$borrow->returnManagedBy->name}} at {{$borrow->returned_at}}</td>
                </tr>
            @endif
        @endcan

        </tbody>
    </table>

    @can('librarian')
        <div class="alert alert-secondary">
            <h3 class="display-6 mb-4 text-secondary">Note: </h3>
            <form class="mb-3" action="{{route('borrows.note', $borrow->id)}}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="note" name="note"
                              placeholder="note">{{ $borrow->note }}</textarea>
                    <label for="note">Note: </label>
                </div>
                <button type="submit" class="btn btn-outline-secondary">Save</button>
            </form>
        </div>

        <h1 class="display-4 mb-4 text-primary">Manage: </h1>
        @if($borrow->status == 'PENDING')
            <div class="d-flex justify-between">
                <form action="{{ route('borrows.refuse', $borrow->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger">Refuse</button>
                </form>

                <form action="{{ route('borrows.accept', $borrow->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Accept</button>
                </form>
            </div>
        @endif


        @if($borrow->status == 'ACCEPTED')
            <div class="d-flex justify-end">
                <form action="{{ route('borrows.returned', $borrow->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Returned</button>
                </form>
            </div>
        @endif
    @endcan



@endsection
