<?php

use Illuminate\Http\Request;
use App\Models\Book;

Route::get('/list', function (Request $request) {
    $query = Book::query();

    // Apply filters if query parameters are present
    if ($request->filled('title')) {
        $query->where('title', $request->title);
    }

    if ($request->filled('author')) {
        $query->where('author', $request->author);
    }

    if ($request->filled('is_available')) {
        $query->where('is_available', $request->is_available);
    }

    // Fetch filtered or full results
    $books = $query->get();

    return view('list', compact('books'));
});
