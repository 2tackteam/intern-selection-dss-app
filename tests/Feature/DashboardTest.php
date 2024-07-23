<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

test('profile page is displayed', function (string $role) {
    $user = User::factory()->create()->assignRole($role);

    $response = actingAs($user)
        ->get('/profile');

    $response->assertOk();
})->with(['admin', 'user']);
