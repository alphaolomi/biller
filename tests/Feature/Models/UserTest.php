<?php

use App\Models\User;

test('it can instantiate a user', function () {
    $user = new User();
    expect($user)->toBeInstanceOf(User::class);
});

test('it can create a user', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@xxx',
        'password' => bcrypt('password'),
    ]);
    expect($user->name)->toBe('John Doe');
    expect($user->email)->toBe('john@xxx');
});


// # scopes and relationships
// scopes
test('it has a scope to get all active users', function () {
    $user = User::factory()->create(['status' => 'active']);
    $inactiveUser = User::factory()->create(['status' => 'inactive']);
    $users = User::active()->get();
    expect($users->count())->toBe(1);
    expect($users->first()->id)->toBe($user->id);
});

// relationships
test('user has houses', function () {
    $user = User::factory()->hasHouses(3)->create();
    expect($user->houses->count())->toBe(3);
});

// functional tests
test('it isAdmin', function () {
    $user = User::factory()->create(['role' => 'admin']);

    expect($user->isAdministrator())->toBeTrue();
});
