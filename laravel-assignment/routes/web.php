<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/list', function () {
    $books = Book::all();
    return view('list', compact('books'));
});
