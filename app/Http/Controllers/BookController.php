<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFormRequest;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowStatus;
use App\Models\Genre;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BookController extends Controller
{

    public function index(Request $request): View
    {
        $query = $request->query('q');

        $q = Book::where('id', '!=', '-1');


        if($query != null)
            $q = $q->where('title', 'like', '%' . $query . '%')
                ->orWhere('authors', 'like', '%' . $query . '%');

        $books = $q->get();

        return view('book.list', [
            'books' => $books,
            'genres' => Genre::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        $tags = Genre::all();
        return view('book.edit', [
            'book' => null,
            'response_url' => route('books.store'),
            'response_method' => 'POST',
            'genres' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookFormRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(BookFormRequest $request): RedirectResponse
    {
        $this->authorize('store', Book::class);

        Book::create($request->validated());
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function show(Book $book)
    {
        $borrowNumber = Borrow::where('book_id', '=', $book->id)->where('status', '=', BorrowStatus::ACCEPTED)->count();
        $borrowed = false;
        $requested = false;
        $deadline = now();

        $user = request()->user();

        $requested = false;

        if($user != null) {
            $acceptedBorrow = Borrow::where('book_id', '=', $book->id)->where('status', '=', BorrowStatus::ACCEPTED)->where('reader_id', '=', $user->id)->first();
            $requestedBorrow = Borrow::where('book_id', '=', $book->id)->where('status', '=', BorrowStatus::PENDING)->where('reader_id', '=', $user->id)->first();

            $requested = $requestedBorrow != null;

            $borrowed = $acceptedBorrow != null;
            $deadline = $acceptedBorrow?->deadline ?? null;
        }

        $availabilityDate = Borrow::where('book_id', '=', $book->id)->where('status', '=', BorrowStatus::ACCEPTED)->first()?->deadline;

//        if($availabilityDate != null)
//            $availabilityDate = date('d/m/Y', $availabilityDate / 1000);


        $requests = [];
        $borrows = [];

        if(Gate::allows('librarian')) {
            $requests = Borrow::where('status', '=', BorrowStatus::PENDING->value)->get();
            $borrows = Borrow::where('status', '=', BorrowStatus::ACCEPTED->value)->get();
        }


        return view('book.details', [
            'book' => $book,
            'available' => $borrowNumber < $book->in_stock,
            'availableNumber' => $book->in_stock - $borrowNumber,
            'requested' => $requested,
            'borrowed' => $borrowed,
            'deadline' => $deadline,
            'availabilityDate' => $availabilityDate,
            'requests' => $requests,
            'borrows' => $borrows
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View
     */
    public function edit(Book $book)
    {
        $tags = Genre::all();

        return view('book.edit', [
            'book' => $book,
            'response_url' => route('books.update', ['book' => $book->id]),
            'response_method' => 'PUT',
            'genres' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookFormRequest $request
     * @param Book $book
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(BookFormRequest $request, Book $book)
    {
        $this->authorize('update', $book);
        $validated = $request->validated();
        $book->update($validated);

        $book->genres()->sync($validated['genres']);

        return redirect()->route('books.show', [
            'book' => $book->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Book $book): RedirectResponse
    {
        $this->authorize('destroy', $book);
        Book::destroy($book->id);
        return redirect()->route('books.index');
    }
}
