<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    // Create a user to test authentication
    $this->user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);
});

test('users can login with correct credentials', function () {
    $response = $this->postJson('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure(['user', 'token']);
});

test('users cannot login with incorrect credentials', function () {
    $response = $this->postJson('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(422);
});

test('users can logout', function () {
    $token = $this->user->createToken('testToken')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson('/api/auth/logout');

    $response->assertStatus(200)
        ->assertJson(['message' => 'Logged out']);
});

test('users can logout a token', function () {
    $token = $this->user->createToken('testToken')->plainTextToken;
    $this->user->createToken('testToken2');

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson('/api/auth/logout', ['token_id' => 'testToken2']);

    $response->assertStatus(200)
        ->assertJson(['message' => 'Logged out']);
});

test('users can logout from all devices', function () {
    $this->user->createToken('testToken1');
    $this->user->createToken('testToken2');

    $response = $this->actingAs($this->user)
        ->postJson('/api/auth/logout-all');

    $response->assertStatus(200)
        ->assertJson(['message' => 'Logged out from all devices']);
});
