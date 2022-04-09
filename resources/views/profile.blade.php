@extends('layouts.main')

@section('content')
    <h1 class="display-4 text-primary me-3 text-wrap-1">Profile</h1>

    <span class="h6 text-primary">Username: </span>
    <p>{{ $user->name }}</p>
    <span class="h6 text-primary">Email: </span>
    <p>{{ $user->email }}</p>
    <span class="h6 text-primary">Role: </span>
    <p>{{ $user->is_librarian ? "Librarian" : "Reader" }}</p>
@endsection
