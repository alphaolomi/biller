<?php

use App\Models\Bill;
use App\Models\House;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    // Create a house and associated bills for testing
    $this->house = House::factory()->create();
    $this->bill = $this->house->bills()->create(
        Bill::factory()->make()->toArray()
    );

    // Authenticate the user
    Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    );
});

test('can list bills for a house', function () {
    $response = $this->getJson("/api/me/houses/{$this->house->id}/bills");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'amount', 'due_date'],
            ],
            'links',
        ]);
});

test('can store a new bill for a house', function () {
    $billData = Bill::factory()->make(['house_id' => $this->house->id])->toArray();

    $response = $this->postJson("/api/me/houses/{$this->house->id}/bills", $billData);

    // expect($response)->dd();

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => ['id', 'amount', 'due_date'], // Adjust based on BillResource
        ]);

    $this->assertDatabaseHas('bills', [
        'id' => $response['data']['id'],
        'amount' => $billData['amount'],
    ]);
});

test('can show a specific bill for a house', function () {
    $response = $this->getJson("/api/me/houses/{$this->house->id}/bills/{$this->bill->id}");

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $this->bill->id,
                // Include other bill attributes in assertion
            ],
        ]);
});

test('can update a bill for a house', function () {
    $updateData = [
        'amount' => 300, // Updated data
    ];

    $response = $this->putJson("/api/me/houses/{$this->house->id}/bills/{$this->bill->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $this->bill->id,
                'amount' => 300,
                // Assert other updated fields if necessary
            ],
        ]);

    $this->assertDatabaseHas('bills', ['id' => $this->bill->id, 'amount' => 300]);
});

test('can delete a bill for a house', function () {
    $response = $this->deleteJson("/api/me/houses/{$this->house->id}/bills/{$this->bill->id}");

    $response->assertStatus(204); // No content

    $this->assertDatabaseMissing('bills', ['id' => $this->bill->id]);
});
