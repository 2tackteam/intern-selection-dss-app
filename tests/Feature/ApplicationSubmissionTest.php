<?php

use App\Enums\EducationLevelEnum;
use App\Enums\GenderEnum;
use App\Models\Application;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();

    $this->hashedRandomId = hashIdsEncode(rand(1, 1000));
});

describe('application submissions page', function () {
    test('page is forbidden', function (string $role) {
        $user = User::query()->with('applications')->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->get(route('application-submissions.index'));

        $response->assertForbidden();
    })->with(['admin']);

    test('page is displayed', function (string $role) {
        $user = User::query()->with('applications')->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->get(route('application-submissions.index'));

        $response->assertOk();
    })->with(['user']);
});

describe('application submissions detail page', function () {
    test('page is forbidden', function (string $role) {
        $user = User::query()->with('applications')->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->get(route('application-submissions.show', $this->hashedRandomId));

        $response->assertForbidden();
    })->with(['admin']);

    test('page is displayed', function (string $role) {
        $user = User::query()->with('applications')->has('applications')->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $hashedApplicationId = hashIdsEncode($user->applications()->inRandomOrder()->first()->id);

        $response = actingAs($user)
            ->get(route('application-submissions.show', $hashedApplicationId));

        $response->assertOk();
    })->with(['user']);
});

describe('application submissions print page', function () {
    test('page is forbidden', function (string $role) {
        $user = User::query()->with('applications')->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->get(route('application-submissions.print', $this->hashedRandomId));

        $response->assertForbidden();
    })->with(['admin']);

    test('page is displayed', function (string $role) {
        $user = User::query()->with('applications')->has('applications')->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $hashedApplicationId = hashIdsEncode($user->applications()->inRandomOrder()->first()->id);

        $response = actingAs($user)
            ->get(route('application-submissions.print', $hashedApplicationId));

        $response->assertOk();
    })->with(['user']);
});

describe('application submissions create page', function () {
    test('page is forbidden', function (string $role) {
        $user = User::query()->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->get(route('application-submissions.create'));

        $response->assertForbidden();
    })->with(['admin']);

    test('page is displayed', function (string $role) {
        $user = User::query()->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->get(route('application-submissions.create'));

        $response->assertOk();
    })->with(['user']);
});

describe('store application submissions', function () {
    beforeEach(function (){

        $educationLevel = fake()->randomElement(EducationLevelEnum::toArray());
        if ($educationLevel === EducationLevelEnum::SHS_VHS->value){
            $gpa = rand(1, 100);
        } else{
            $gpa = rand(1.00, 4.00);
        }
        $year = now()->year;
        $startYear = $year - rand(1, 10);
        $endYear = $startYear + rand(1, 4);

        $this->validData = [
            'full_name' => fake()->name,
            'birth_place' => fake()->city,
            'birth_date' => fake()->date,
            'gender' => fake()->randomElement(GenderEnum::toArray()),
            'education_level' => $educationLevel,
            'institution_name' => fake()->company,
            'major' => fake()->randomElement(range('A', 'Z')),
            'start_year' => $startYear,
            'end_year' => $endYear,
            'gpa' => $gpa,
        ];
    });


    test('store is forbidden', function (string $role) {
        $user = User::query()->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->post(route('application-submissions.store', $this->validData));

        $response->assertForbidden();
    })->with(['admin']);

    test('can store data', function (string $role) {
        $user = User::query()->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->post(route('application-submissions.store', $this->validData));

        $response->assertRedirectToRoute('application-submissions.index')
            ->assertSessionHas('notify');
    })->with(['user']);

    test('can handle invalid request', function (string $role) {
        $user = User::query()->whereRelation('roles', 'name', $role)->inRandomOrder()->firstOrFail();

        $response = actingAs($user)
            ->post(route('application-submissions.store'));

        $response->assertInvalid([
            'full_name','birth_place','birth_date', 'gender',
            'education_level','institution_name','major',
            'start_year','end_year','gpa',
        ]);
    })->with(['user']);
});

