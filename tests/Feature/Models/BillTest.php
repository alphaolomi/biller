<?php

use App\Models\Bill;
use App\Models\House;

test('it can instantiate a user', function () {
    $bill = new Bill();

    expect($bill)->toBeInstanceOf(Bill::class);
});

test('it can create a bill', function () {
    $house = House::factory()->create();
    $bill = Bill::create([
        'house_id' => $house->id,
        'description' => 'Electricity bill',
        'amount' => 100_000,
        'currency' => 'TZS',
        'due_date' => now(),
        'type' => 'electricity',
        'shared' => false
    ]);

    expect($bill->house_id)->toBe(1);
    expect($bill->description)->toBe('Electricity bill');
    expect($bill->amount)->toBe(100000);
    expect($bill->currency)->toBe('TZS');
    expect($bill->type)->toBe('electricity');
    expect($bill->shared)->toBeFalse();
});
