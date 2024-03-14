<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use App\Http\Resources\AttachmentResource;
use App\Models\Bill;

class BillAttachmentController extends Controller
{

    public function index(Bill $bill)
    {
        $attachments = $bill->attachments()->paginate(10);

        return AttachmentResource::collection($attachments);
    }

    public function store(StoreAttachmentRequest $request, Bill $bill)
    {
        $attachment = $bill->attachments()->create($request->all());

        return new AttachmentResource($attachment);
    }

    public function show(Attachment $attachment)
    {
        return new AttachmentResource($attachment);
    }


    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
    {
        $attachment->update($request->all());

        return new AttachmentResource($attachment);
    }

    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return response()->noContent();
    }
}