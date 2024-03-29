<?php

use App\Models\House;

test('it can instantiate a user', function () {
    $house = new House();
    expect($house)->toBeInstanceOf(House::class);
});

test('it can create a house', function () {
    $house = House::factory()->create([
        'name' => 'Kimara',
        'address' => 'Kimara, Dar es Salaam',
        'description' => 'A nice place to live',
    ]);
    expect($house->name)->toBe('Kimara');
    expect($house->address)->toBe('Kimara, Dar es Salaam');
    expect($house->description)->toBe('A nice place to live');

    // # Relations
    // users
    expect($house->user)->toBeInstanceOf(\App\Models\User::class);

    // bills
    expect($house->bills)->toBeInstanceOf(\Illuminate\Database\Eloquent\Collection::class);
});
