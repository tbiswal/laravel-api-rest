<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use App\Models\User;
use App\Rules\IsValidEmailAddress;
use InvalidArgumentException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksController10ExceptionTest extends TestCase
{
    use RefreshDatabase;

    public function testValidEmailAddress()
    {
        $rule = new IsValidEmailAddress();

        $this->assertTrue($rule->passes('email', 'me@you.com'));
    }

    public function testEmailAddressWithException()
    {
        $this->expectException(
            InvalidArgumentException::class
        ); // Always need to be at top in PHP Unit

        $rule = new IsValidEmailAddress();

        $this->assertTrue($rule->passes('email', 1));
    }
}
