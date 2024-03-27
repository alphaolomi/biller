<?php

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Spatie\WebhookServer\CallWebhookJob;

test('webhook', function () {
    Bus::fake();
    $response = $this->post(route('dev.test-webhook'), [
        'url' => 'https://webhook.site/20b2657c-3f2d-468c-b5f1-6e6ee68f2b5c'
    ]);

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Webhook sent']);

    // We can assert that the job was dispatched
    Bus::assertDispatched(CallWebhookJob::class);
    // We can also assert the webhook URL
    Bus::assertDispatched(CallWebhookJob::class, function ($job) {
        return $job->webhookUrl === 'https://webhook.site/20b2657c-3f2d-468c-b5f1-6e6ee68f2b5c';
    });
});



test('webhook queue', function () {
    Queue::fake();
    $response = $this->post(route('dev.test-webhook'));

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Webhook sent']);

    Queue::assertPushed(CallWebhookJob::class);
});
