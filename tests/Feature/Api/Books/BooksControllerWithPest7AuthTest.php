<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use function Pest\Faker\faker;

uses(RefreshDatabase::class);

it('can list all the books', function () {
    login()->json('GET', route('books.index'), [], [])->assertStatus(200);
});

it('can list a specific book', function () {
    $book = Book::factory()->create();

    login()->json('GET', route('books.show', $book->id), [], [])
        ->assertStatus(200);
});


it('can store book', function () {
    $data = [
        'title'  => faker()->text(20),
        'price'  => faker()->numberBetween(45, 60) . '$',
        'author' => faker()->name,
        'editor' => faker()->text(20),
    ];

    login()->json('POST', route('books.store'), $data, [])
        ->assertStatus(201);
});

it('can update book', function () {
    $book = Book::factory()->create();

    $data = [
        'id'     => 1,
        'title'  => faker()->text(20),
        'price'  => faker()->numberBetween(45, 60) . '$',
        'author' => faker()->name,
        'editor' => faker()->text(20),
    ];
    login()->json('PUT', route('books.update', $book->id), $data, [])
        ->assertStatus(200);
});

it('can delete book', function () {
    $book = Book::factory()->create();

    login()->json('DELETE', route('books.destroy', $book->id), [], [])
        ->assertStatus(204);
});
