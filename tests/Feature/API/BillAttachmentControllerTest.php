<?php

use App\Models\Attachment;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    // Create a bill for testing
    $this->bill = Bill::factory()->create();

    // Authenticate the user
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user, ['*']);
});

test('can retrieve all attachments for a bill', function () {
    $bill = Bill::factory()->create();
    $attachments = Attachment::factory()->count(3)->for($bill)->withNullFile()->create();

    $response = $this->getJson("/api/me/bills/{$bill->id}/attachments");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    // Attributes based on AttachmentResource
                ],
            ],
            'links', 'meta',
        ]);
});

test('can store a new attachment for a bill', function () {
    Storage::fake();

    $file = UploadedFile::fake()->image('receipt.jpg');

    $bill = Bill::factory()->create();
    $attachmentData = [
        'name' => 'Bill Receipt',
        'bill_id' => $bill->id,
        'file' => $file,
    ];

    $response = $this->postJson("/api/me/bills/{$bill->id}/attachments", $attachmentData);

    $response->assertCreated()
        ->assertJsonStructure([
            'data' => [
                // Attributes based on AttachmentResource
            ],
        ]);
});

test('can show a specific attachment', function () {
    $attachment = Attachment::factory()->forBill()->withNullFile()->create();

    $response = $this->getJson("/api/me/attachments/{$attachment->id}");

    $response->assertOk()
        ->assertJson([
            'data' => [
                'id' => $attachment->id,
                // Other attributes from AttachmentResource
            ],
        ]);
});

test('can update a specific attachment', function () {
    $attachment = Attachment::factory()->forBill()->withNullFile()->create();
    $updateData = [
        // Data according to UpdateAttachmentRequest validation rules
    ];

    $response = $this->putJson("/api/me/attachments/{$attachment->id}", $updateData);

    $response->assertOk()
        ->assertJson([
            'data' => [
                'id' => $attachment->id,
                // Updated attributes
            ],
        ]);
});

test('can destroy a specific attachment', function () {
    $attachment = Attachment::factory()->forBill()->withNullFile()->create();

    $response = $this->deleteJson("/api/me/attachments/{$attachment->id}");

    $response->assertNoContent();
    // $this->assertDeleted($attachment);
});
