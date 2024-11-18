<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Author Routes
Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
Route::get('/authors/{id}/books', [AuthorController::class, 'authorBook'])->name('authors.authorBook');

// Sales Data Routes
Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');