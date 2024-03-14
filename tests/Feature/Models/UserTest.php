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
        'password' => bcrypt('password')
    ]);
    expect($user->name)->toBe('John Doe');
    expect($user->email)->toBe('john@xxx');
});
