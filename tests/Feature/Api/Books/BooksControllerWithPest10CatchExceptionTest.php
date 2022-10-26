<?php

namespace Tests\Feature\Api\Books;

use App\Rules\IsValidEmailAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;

uses(RefreshDatabase::class);
uses()->group('exception');

it('can validate an email', function () {
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 'me@you.com'))->toBeTrue();

});

it('throws an exception if the email is not a string', function (){
    $this->expectException(InvalidArgumentException::class); // Always need to be at top in PHP Unit
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 1))->toBeTrue();
});

it('better exception handling if the email is not a string', function (){
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 1))->toBeTrue();
})->throws(InvalidArgumentException::class);
