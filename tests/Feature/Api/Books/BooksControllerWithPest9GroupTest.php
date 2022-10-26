<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Faker\faker;

uses(RefreshDatabase::class);

it('can list all the books', function () {
    login()->get('api/books')
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => array(
                '*' => array(
                    'id',
                    'title',
                    'price',
                    'author',
                    'editor',
                )
            )
        ]);
})->group('rflab');

it('can list a specific book', function () {
    $book = Book::factory()->create();

    login()->get('/api/books/' . $book->id)
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'price',
                'author',
                'editor',
            ],
        ]);
});


it('can store a book', function () {
    $data = [
        'title'  => faker()->text(20),
        'price'  => faker()->numberBetween(45, 60) . '$',
        'author' => faker()->name,
        'editor' => faker()->text(20),
    ];

    login()->post('/api/books', $data)
        ->assertStatus(201);
});

it('can update a book', function () {
    $book = Book::factory()->create();

    $data = [
        'id'     => 1,
        'title'  => faker()->text(20),
        'price'  => faker()->numberBetween(45, 60) . '$',
        'author' => faker()->name,
        'editor' => faker()->text(20),
    ];
    login()->put('/api/books/' . $book->id, $data)
        ->assertStatus(200);
});

it('can delete book', function () {
    $book = Book::factory()->create();

    login()->delete('/api/books/' . $book->id)
        ->assertStatus(204);
});
