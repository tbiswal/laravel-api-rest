<?php

namespace Tests\Feature\Api\Books;

use App\Rules\IsValidEmailAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;

uses(RefreshDatabase::class);
uses()->group('hooks');

beforeAll(function () {echo 'Before All' . "\n";});
beforeEach(function () {echo 'Before Each' . "\n";});
afterEach(function () {echo 'After Each' . "\n";});
afterAll(function () {echo 'After All' . "\n";});

it('can validate an email', function () {
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 'me@you.com'))->toBeTrue();
});

it('throws an exception if the email is not a string', function () {
    $this->expectException(
        InvalidArgumentException::class
    ); // Always need to be at top in PHP Unit
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 1))->toBeTrue();
});

it('better exception handling if the email is not a string', function () {
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 1))->toBeTrue();
})->skip('We no longer want to test the exception')
    ->throws(InvalidArgumentException::class);

it('Skip with conditional', function () {
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 1))->toBeTrue();
})->skip(
    getenv('SKIP_TESTS') ?? false,
    'We no longer want to test the exception'
)->throws(InvalidArgumentException::class)->group('current');

it('Skip with conditional using config', function () {
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 1))->toBeTrue();
})->skip(
    fn() => config('app.name') === 'foo', 'We no longer want to test the exception'
)->throws(InvalidArgumentException::class);
