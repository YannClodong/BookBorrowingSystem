<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::resource('/', WelcomeController::class);
Route::resource('/profile', ProfileController::class);

Route::resource('books', BookController::class);
Route::resource('genres', GenreController::class);


Route::resource('borrows', BorrowController::class);


Route::middleware('auth')->group(function() {
    Route::post('/borrows/create', [BorrowController::class, 'store'])->name('borrows.store');
    Route::post('/borrows/{borrow}/accept', [BorrowController::class, 'accept'])->name('borrows.accept');
    Route::post('/borrows/{borrow}/refuse', [BorrowController::class, 'refuse'])->name('borrows.refuse');
    Route::post('/borrows/{borrow}/returned', [BorrowController::class, 'returned'])->name('borrows.returned');
    Route::post('/borrows/{borrow}/deadline', [BorrowController::class, 'changeDeadline'])->name('borrows.deadline');
    Route::post('/borrows/{borrow}/note', [BorrowController::class, 'editNote'])->name('borrows.note');
});
