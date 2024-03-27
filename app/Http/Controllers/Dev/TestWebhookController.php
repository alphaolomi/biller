<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\WebhookServer\WebhookCall;

class TestWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $to = 'https://webhook.site/20b2657c-3f2d-468c-b5f1-6e6ee68f2b5c';
        WebhookCall::create()
            ->url($to)
            ->payload(['key' => 'value'])
            ->useSecret('sign-using-this-secret')
            ->dispatch();

        return response()->json(['message' => 'Webhook sent']);
    }
}
