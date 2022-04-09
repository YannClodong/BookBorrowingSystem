<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreFormRequest;
use App\Models\Book;
use App\Models\Genre;
use App\Models\GenreStyle;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::all();

        return view('genres.list', [
            'genres' => $genres
        ]);
    }

    public function show(Genre $genre) {

        return view('genres.show', [
            'books' => $genre->books,
            'genres' => Genre::all(),
            'genre' => $genre
        ]);
    }

    public function create() {
        return view('genres.edit', [
            'form_action' => route('genres.store'),
            'form_method' => 'POST',
            'genre' => null
        ]);
    }

    public function edit(Genre $genre) {
        return view('genres.edit', [
            'form_action' => route('genres.update', [ 'genre' => $genre->id ]),
            'form_method' => 'PUT',
            'genre' => $genre
        ]);
    }

    public function store(GenreFormRequest $request) {
//        $this->authorize('create');
        Genre::create($request->customValidated());
        return redirect()->route('genres.index');
    }

    public function update(GenreFormRequest $request, Genre $genre) {
        $genre->update($request->customValidated());
        return redirect()->route('genres.index');
    }

    public function destroy(Genre $genre) {
        $genre->deleteOrFail();
        return redirect()->route('genres.index');
    }
}
