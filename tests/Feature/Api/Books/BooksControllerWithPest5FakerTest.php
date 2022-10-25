<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use function Pest\Faker\faker;

uses(RefreshDatabase::class);
uses(WithoutMiddleware::class);

it('can store book', function () {
    // The faker() function will create an instance of the Faker generator with the default locale (en_US).
    // Change locale $name = faker('fr_FR')->name;

    $data = [
        'title'  => faker()->text(20),
        'price'  => faker()->numberBetween(45, 60) . '$',
        'author' => faker()->name,
        'editor' => faker()->text(20),
    ];

    /*dd(
        faker('fr_FR')->text(20),
        faker()->numberBetween(45, 60) . '$',
        faker('fr_FR')->name,
        faker('fr_FR')->text(20)
    );*/

    $this->json('POST', route('books.store'), $data, [])
        ->assertStatus(201);

    $book = Book::latest()->first();

    // Chain
    expect($book->title)->toBeString()->not->toBeEmpty()
        ->and($book->price)->toBeString()->not->toBeEmpty()
        ->and($book->price)->toBeString()->toContain('$');
});

