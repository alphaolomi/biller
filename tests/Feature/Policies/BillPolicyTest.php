<?php

use App\Models\Bill;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->bill = Bill::factory()->create();
});

test('user can view any bills', function () {
    expect($this->user->can('viewAny', Bill::class))->toBeTrue();
});

test('user can view a bill', function () {
    expect($this->user->can('view', $this->bill))->toBeTrue();
});

test('user can create a bill', function () {
    expect($this->user->can('create', Bill::class))->toBeTrue();
});

test('user can update a bill', function () {
    expect($this->user->can('update', $this->bill))->toBeTrue();
});

test('user can delete a bill', function () {
    expect($this->user->can('delete', $this->bill))->toBeTrue();
});

test('user can restore a bill', function () {
    expect($this->user->can('restore', $this->bill))->toBeTrue();
});

test('user can permanently delete a bill', function () {
    expect($this->user->can('forceDelete', $this->bill))->toBeTrue();
});
