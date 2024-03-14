<?php

use App\Models\House;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    // Create sample houses for testing if necessary
    House::factory()->count(5)->create();

    // Authenticate the user
    Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    );
});

test('can return a paginated list of houses', function () {
    $response = $this->getJson('/api/me/houses');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'address', 'name', 'description'],
            ],
            'links', 'meta',
        ]);
});

test('can store a new house', function () {

    $houseData = House::factory()->make(['address' => '123 Main St'])->toArray();

    $response = $this->postJson('/api/me/houses', $houseData);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => ['id', 'name', 'address', 'description'],
        ]);

    $this->assertDatabaseHas('houses', ['address' => '123 Main St']);
});

test('can show a house', function () {
    $house = House::first();

    $response = $this->getJson("/api/me/houses/{$house->id}");

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $house->id,
                'address' => $house->address,
                // Include assertions for other fields
            ],
        ]);
});

test('can update a house', function () {
    $house = House::first();
    $updateData = [
        'address' => 'Updated Address',
        'name' => 'Updated Name',
        'description' => 'Updated Description',
    ];

    $response = $this->putJson("/api/me/houses/{$house->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $house->id,
                'address' => 'Updated Address',
                'name' => 'Updated Name',
                'description' => 'Updated Description',
            ],
        ]);

    $this->assertDatabaseHas('houses', [
        'id' => $house->id,
        'address' => 'Updated Address',
        'name' => 'Updated Name',
        'description' => 'Updated Description',
    ]);
});

test('can delete a house', function () {
    $house = House::first();

    $response = $this->deleteJson("/api/me/houses/{$house->id}");

    $response->assertStatus(204); // No content

    $this->assertDatabaseMissing('houses', ['id' => $house->id]);
});
