<?php

use App\Models\House;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->house = House::factory()->create();
});

test('user can view any houses', function () {
    expect($this->user->can('viewAny', House::class))->toBeTrue();
});

test('user can view a house', function () {
    expect($this->user->can('view', $this->house))->toBeTrue();
});

test('user can create a house', function () {
    expect($this->user->can('create', House::class))->toBeTrue();
});

test('user can update a house', function () {
    expect($this->user->can('update', $this->house))->toBeTrue();
});

test('user can delete a house', function () {
    expect($this->user->can('delete', $this->house))->toBeTrue();
});

test('user can restore a house', function () {
    expect($this->user->can('restore', $this->house))->toBeTrue();
});

test('user can permanently delete a house', function () {
    expect($this->user->can('forceDelete', $this->house))->toBeTrue();
});
