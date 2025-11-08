<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello/{name?}', function ($name = null) {
    return view('home', ['name' => $name]);
});

Route::get('/loop' , function () {
    $names = ['Rahul', 'Ram', 'Pooja'];
    return view('loop', ['names' => $names]);
});
// Route::get('/todos', function () {
//     $todos = [
//         [
//             'description' => 'My first todo',
//             'due_date' => '2025-09-30',
//             'is_completed' => false
//         ],
//         [
//             'description' => 'My second todo',
//             'due_date' => '2025-10-05',
//             'is_completed' => true
//         ]
//     ];

//     return view('todos', ['todos' => $todos]);
// });
Route::get( url'/todos',[\App\Http\Controllers\TodosController :: class, 'index']);
Route::get('/todos/{todo}/edit',[\App\Http\(table)])