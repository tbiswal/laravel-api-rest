<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BooksController3Test extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testBookStore()
    {
        $data = [
            'title'  => "title #2",
            'price'  => "49$",
            'author' => "author #2",
            'editor' => "editor #2",
        ];

        $this->json('POST', route('books.store'), $data, [])
            ->assertStatus(201);
    }
}
