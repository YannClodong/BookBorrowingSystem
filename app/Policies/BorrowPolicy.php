<?php

namespace App\Policies;

use App\Models\Borrow;
use App\Models\BorrowStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class BorrowPolicy
{
    use HandlesAuthorization;

    public function list(User $user): bool
    {
        return Gate::allows('librarian');
    }

    public function show(User $user): bool
    {
        return true;//Gate::allows('librarian');
    }

    public function store(User $user): bool
    {
        return true;
    }

    public function acceptRefuse(User $user, Borrow $borrow): bool
    {
        return Gate::allows('acceptRefuseGate', $borrow);
    }

    public function returned(User $user, Borrow $borrow): bool
    {
        return Gate::allows('librarian') && $borrow->status == BorrowStatus::ACCEPTED->value;
    }

    public function changeDeadline(User $user, Borrow $borrow) {
        return Gate::allows('librarian') && $borrow->status == BorrowStatus::ACCEPTED->value;
    }

    public function note(User $user, Borrow $borrow) {
        return Gate::allows('librarian');
    }
}
