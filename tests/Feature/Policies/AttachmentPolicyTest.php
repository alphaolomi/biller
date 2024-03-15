<?php

use App\Models\Attachment;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->attachment = Attachment::factory()->withFile()->create();
});

test('user can view any attachments', function () {
    expect($this->user->can('viewAny', Attachment::class))->toBeTrue();
});

test('user can view an attachment', function () {
    expect($this->user->can('view', $this->attachment))->toBeTrue();
});

test('user can create an attachment', function () {
    expect($this->user->can('create', Attachment::class))->toBeTrue();
});

test('user can update an attachment', function () {
    expect($this->user->can('update', $this->attachment))->toBeTrue();
});

test('user can delete an attachment', function () {
    expect($this->user->can('delete', $this->attachment))->toBeTrue();
});

test('user can restore an attachment', function () {
    expect($this->user->can('restore', $this->attachment))->toBeTrue();
});

test('user can permanently delete an attachment', function () {
    expect($this->user->can('forceDelete', $this->attachment))->toBeTrue();
});
