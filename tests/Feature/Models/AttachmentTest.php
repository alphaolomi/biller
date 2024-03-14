<?php

use App\Models\Attachment;

test('it can instantiate an attachment', function () {
    $attachment = new Attachment();
    expect($attachment)->toBeInstanceOf(Attachment::class);
});
