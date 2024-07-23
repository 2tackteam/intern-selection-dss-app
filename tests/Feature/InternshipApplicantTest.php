<?php

use App\Models\Application;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();

    $this->hashedApplicationId = hashIdsEncode(Application::query()->inRandomOrder()->first()->id);
});

describe('internship applicants page', function () {
    test('page is forbidden', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.index'));

        $response->assertForbidden();
    })->with(['user']);

    test('page is displayed', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.index'));

        $response->assertOk();
    })->with(['admin']);
});

describe('internship applicants detail page', function () {
    test('page is forbidden', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.show', $this->hashedApplicationId));

        $response->assertForbidden();
    })->with(['user']);

    test('page is displayed', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.show', $this->hashedApplicationId));

        $response->assertOk();
    })->with(['admin']);
});

describe('internship applicants print page', function () {
    test('page is forbidden', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.print', $this->hashedApplicationId));

        $response->assertForbidden();
    })->with(['user']);

    test('page is displayed', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.print', $this->hashedApplicationId));

        $response->assertOk();
    })->with(['admin']);
});

describe('internship applicants selection page', function () {

    test('page is forbidden', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.applicant-selection'));

        $response->assertForbidden();
    })->with(['user']);

    test('page is displayed', function (string $role) {
        $user = User::factory()->create()->assignRole($role);

        $response = actingAs($user)
            ->get(route('internship-applicants.applicant-selection'));

        $response->assertOk();
    })->with(['admin']);
});
