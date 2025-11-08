<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
       $todos = [
        [
            'description' => 'My first todo',
            'due_date' => '2025-09-30',
            'is_completed' => false
        ],
        [
            'description' => 'My second todo',
            'due_date' => '2025-10-05',
            'is_completed' => true
        ]
        ];
     return view('todos', ['todos' => $todos]);
    }

    {public function edit()
        {}

}
