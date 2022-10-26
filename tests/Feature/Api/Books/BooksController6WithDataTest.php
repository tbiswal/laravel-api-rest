<?php

namespace Tests\Feature\Api\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Faker\Factory as Faker;

class BooksController6WithDataTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testBookStore()
    {
        $faker = Faker::create();

        $dataSet1 = [
            'title'  => $faker->text(20),
            'price'  => '49$',
            'author' => $faker->name,
            'editor' => $faker->text(20),
        ];

        $this->json('POST', route('books.store'), $dataSet1, [])
            ->assertStatus(201);

        $dataSet2 = [
            'title'  => $faker->text(20),
            'price'  => '50.5$',
            'author' => $faker->name,
            'editor' => $faker->text(20),
        ];

        $this->json('POST', route('books.store'), $dataSet2, [])
            ->assertStatus(201);

        $dataSet3 = [
            'title'  => $faker->text(20),
            'price'  => '100$',
            'author' => $faker->name,
            'editor' => $faker->text(20),
        ];

        $this->json('POST', route('books.store'), $dataSet3, [])
            ->assertStatus(201);
    }
}
