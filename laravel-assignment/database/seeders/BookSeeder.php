<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::insert([
            ['title' => 'Laravel Basics', 'author' => 'John Doe', 'pages' => 200, 'published_date' => '2023-01-01', 'is_available' => true],
            ['title' => 'PHP Mastery', 'author' => 'Jane Smith', 'pages' => 300, 'published_date' => '2022-05-10', 'is_available' => true],
            ['title' => 'Eloquent ORM', 'author' => 'Alice', 'pages' => 150, 'published_date' => '2021-08-15', 'is_available' => false],
            ['title' => 'Laravel Advanced', 'author' => 'Bob', 'pages' => 250, 'published_date' => '2020-12-20', 'is_available' => true],
            ['title' => 'Testing in Laravel', 'author' => 'Charlie', 'pages' => 180, 'published_date' => '2024-03-05', 'is_available' => false],
        ]);
    }
}
