<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowStatus;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index() {

        $borrowedBook = Borrow::select("*", DB::raw('count("book_id") as borrow_times'))
            ->where('status', '!=', BorrowStatus::REJECTED->value)
            ->where('status', '!=', BorrowStatus::PENDING->value)
            ->groupBy("book_id")
            ->orderBy("borrow_times", "desc")
            ->limit(3)
            ->get()
            ->map(function($e) {
               return $e->book;
            });

        return view('welcome', [
            'bookNo' => Book::count(),
            'genreNo' => Genre::count(),
            'userNo' => User::count(),
            'borrowNo' => Borrow::where('status', BorrowStatus::ACCEPTED->value)->count(),
            'borrows' => $borrowedBook,
            'genres' => Genre::all()
        ]);
    }
}
