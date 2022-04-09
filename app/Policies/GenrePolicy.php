<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class GenrePolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return Gate::allows('librarian');
    }

    public function update(User $user, Genre $genre): bool
    {
        return Gate::allows('librarian');
    }

    public function delete(User $user, Genre $genre): bool
    {
        return Gate::allows('librarian');
    }
}
