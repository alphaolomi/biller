<?php

use App\Models\User;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;

beforeEach(function () {
    // Create a user for testing
    $this->user = User::factory()->create([
        'name' => 'Original Name',
    ]);

    // Authenticate as the user
    $this->actingAs($this->user);
});

test('profile can be shown', function () {
    $response = getJson('/api/auth/profile');

    $response->assertStatus(200);
        // ->assertJson([
        //     'id' => $this->user->id,
        //     'name' => 'Original Name',
        // ])
});

test('profile can be updated', function () {
    $updatedName = 'Updated Name';

    $response = putJson('/api/auth/profile', [
        'name' => $updatedName,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'id' => $this->user->id,
            'name' => $updatedName,
        ]);

    $this->assertDatabaseHas('users', [
        'id' => $this->user->id,
        'name' => $updatedName,
    ]);
});
