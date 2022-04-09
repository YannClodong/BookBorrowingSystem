<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class BookPolicy
{
    use HandlesAuthorization;

    public function store(User $user): bool
    {
        return Gate::allows('librarian');
    }

    public function update(User $user, Book $book): bool
    {
        return Gate::allows('librarian');
    }

    public function destroy(User $user, Book $book): bool
    {
        return Gate::allows('librarian');
    }
}
