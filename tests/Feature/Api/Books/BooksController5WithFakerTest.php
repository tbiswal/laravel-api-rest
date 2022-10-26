<?php

namespace Tests\Feature\Api\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Faker\Factory as Faker;

class BooksController5WithFakerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testBookStore()
    {
        $faker = Faker::create();

        $data = [
            'title'  => $faker->text(20),
            'price'  => $faker->numberBetween(45, 60) . '$',
            'author' => $faker->name,
            'editor' => $faker->text(20),
        ];

        $this->json('POST', route('books.store'), $data, [])
            ->assertStatus(201);
    }
}
