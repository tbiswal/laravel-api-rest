<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

uses(RefreshDatabase::class);
uses(WithoutMiddleware::class);

it('can list all the books', function () {
    $this->json('GET', route('books.index'), [], [])->assertStatus(200);
});

it('can list a specific book', function () {
    $book = Book::factory()->create();

    $this->json('GET', route('books.show', $book->id), [], [])
        ->assertStatus(200);
});

it('can store book', function () {
    $data = [
        'title'  => "title #2",
        'price'  => "price #2",
        'author' => "author #2",
        'editor' => "editor #2",
    ];

    $this->json('POST', route('books.store'), $data, [])
        ->assertStatus(201);
});

it('can update book', function () {
    $book = Book::factory()->create();

    $data = [
        'id'     => 1,
        'title'  => "title #1 update",
        'price'  => "price #1 update",
        'author' => "author #1 update",
        'editor' => "editor #1 update",
    ];
    $this->json('PUT', route('books.update', $book->id), $data, [])
        ->assertStatus(200);
});

it('can delete book', function () {
    $book = Book::factory()->create();

    $this->json('DELETE', route('books.destroy', $book->id), [], [])
        ->assertStatus(204);
});
