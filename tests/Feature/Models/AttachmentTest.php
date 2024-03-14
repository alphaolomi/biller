<?php

use App\Models\Attachment;
use App\Models\Bill;

test('it can instantiate an attachment', function () {
    $attachment = new Attachment();
    expect($attachment)->toBeInstanceOf(Attachment::class);
});


test('it can create an attachment', function () {
    $bill = Bill::factory()->create();
    $attachment = Attachment::create([
        'name' => 'Attachment Name',
        'bill_id' => $bill->id,
        'file_path' => 'path/to/attachment',
    ]);
    expect($attachment->bill_id)->toBe($bill->id);
    expect($attachment->file_path)->toBe('path/to/attachment');
    expect($attachment->bill)->toBeInstanceOf(Bill::class);
    expect($attachment->bill())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    //
});
