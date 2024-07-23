<?php

use App\Models\User;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

test('registration screen can be rendered', function () {
    $response = get('/register');

    $response->assertOk();
});

test('new users can register', function () {
    $response = post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $user = User::firstWhere('email', '=', 'test@example.com');

    assertAuthenticated();
    assertAuthenticatedAs($user);
    expect($user->roles->first()->name)->toBe('user');
    $response->assertRedirect(route('dashboard', absolute: false));
});
