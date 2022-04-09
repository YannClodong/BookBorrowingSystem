<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeDeadline;
use App\Http\Requests\NoteBorrow;
use App\Models\Book;
use App\Models\Borrow;
use App\Http\Requests\StoreBorrowRequest;
use App\Models\BorrowStatus;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BorrowController extends Controller
{

    public function index(User $user) {
        if(Gate::allows('librarian')) {
            $borrows = Borrow::all();
            return view("borrow.list", [
                'borrows' => $borrows
            ]);
        } else {
            $borrows = Borrow::where('reader_id', '=', Auth::user()->id)->get();
            return view("borrow.myrentals", [
                'borrows' => $borrows
            ]);
        }

    }

    public function show(Borrow $borrow) {
        $this->authorize('show', Borrow::class);

        return view('borrow.details', [
            'borrow' => $borrow
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBorrowRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(User $user, StoreBorrowRequest $request)
    {
//        dd($request->user()->id );
        $this->authorize('store', Borrow::class);
        $value = $request->validated();

//        $book = Book::findOrFail($value->book_id);
//        $borrowed = Borrow::where('status', '=', BorrowStatus::ACCEPTED).where('book_id', '=', $value->book_id)->cound();

        Borrow::create([
            'reader_id' => $request->user()->id,
            'book_id' => $value['book_id'],
            'status' => BorrowStatus::PENDING
        ]);
        return redirect()->route('books.show', ['book' => $value['book_id']]);
    }


    public function accept(User $user, Borrow $borrow): Redirector|RedirectResponse|Application
    {
        $this->authorize('acceptRefuse', $borrow);

        // Check that a book is available.
        $book = Book::findOrFail($borrow->book_id);
        $borrowed = Borrow::where('book_id', '=', $borrow->book_id)->where('status', '=', BorrowStatus::ACCEPTED)->count();

        if($borrowed >= $book->in_stock)
            return abort(404, 'No version of this book available.');

        // Accept the request
        $borrow->update([
            'status' => BorrowStatus::ACCEPTED,
            'request_managed_by' => Auth::user()->id,
            'request_processed_at' => now()
        ]);

        return redirect()->route('borrows.show', $borrow->id);
    }

    public function refuse(User $user, Borrow $borrow) {
        $this->authorize('acceptRefuse', $borrow);
        $borrow->update([
            'status' => BorrowStatus::REJECTED,
            'request_managed_by' => Auth::user()->id,
            'request_processed_at' => now()
        ]);

        return redirect()->route('borrows.show', $borrow->id);
    }

    public function returned(User $user, Borrow $borrow) {
        $this->authorize('returned', $borrow);

        $borrow->update([
            'status' => BorrowStatus::RETURNED,
            'returned_at' => now(),
            'return_managed_by' => Auth::user()->id
        ]);
        return redirect()->route('borrows.show', $borrow->id);
    }

    public function changeDeadline(ChangeDeadline $request, Borrow $borrow) {
        $this->authorize('changeDeadline', $borrow);

        $borrow->update($request->validated());

        return redirect()->route('borrows.show', $borrow->id);
    }

    public function editNote(NoteBorrow $request, Borrow $borrow) {
        $this->authorize('note', $borrow);

        $borrow->update($request->validated());


        return redirect()->route('borrows.show', $borrow->id);
    }
}
