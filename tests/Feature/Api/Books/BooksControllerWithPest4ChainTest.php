<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

uses(RefreshDatabase::class);
uses(WithoutMiddleware::class);

it('can store book', function () {
    $data = [
        'title'  => "title #2",
        'price'  => "49$",
        'author' => "author #2",
        'editor' => "editor #2",
    ];

    $this->json('POST', route('books.store'), $data, [])
        ->assertStatus(201);

    $book = Book::latest()->first();

    // Chain
    expect($book->title)->toBeString()->not->toBeEmpty()
        ->and($book->price)->toBeString()->not->toBeEmpty()
        ->and($book->price)->toBeString()->toContain('$')
        ->and($book->price)->toBe('49$');
});

