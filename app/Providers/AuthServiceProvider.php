<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowStatus;
use App\Policies\BookPolicy;
use App\Policies\BorrowPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Book::class => BookPolicy::class,
        Borrow::class => BorrowPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('librarian', function($user) {
            return $user->is_librarian;
        });

        Gate::define('acceptRefuseGate', function($user, $borrow) {
            return $user->is_librarian && $borrow->status == BorrowStatus::PENDING->value;
        });
        //
    }
}
