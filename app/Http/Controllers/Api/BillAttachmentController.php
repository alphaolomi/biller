<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAttachmentRequest;
use App\Http\Requests\Api\UpdateAttachmentRequest;
use App\Http\Resources\AttachmentResource;
use App\Models\Attachment;
use App\Models\Bill;
use Illuminate\Support\Facades\Gate;

class BillAttachmentController extends Controller
{
    public function index(Bill $bill)
    {

        $user = auth()->user();

        Gate::authorize('viewAny', [$bill, $user]);

        $attachments = $bill->attachments()->paginate(10);

        return AttachmentResource::collection($attachments);
    }

    public function store(StoreAttachmentRequest $request, Bill $bill)
    {
        $user = auth()->user();

        Gate::authorize('create', [$bill, $user]);

        $file_path = $request->file('file')->store('attachments');

        $request->merge(['file_path' => $file_path]);

        $attachment = $bill->attachments()->create($request->all());

        return new AttachmentResource($attachment);
    }

    public function show(Attachment $attachment)
    {

        $user = auth()->user();

        Gate::authorize('view', [$attachment, $user]);

        return new AttachmentResource($attachment);
    }

    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
    {

        $user = auth()->user();

        Gate::authorize('update', [$attachment, $user]);

        $attachment->update($request->all());

        return new AttachmentResource($attachment);
    }

    public function destroy(Attachment $attachment)
    {

        $user = auth()->user();

        Gate::authorize('delete', [$attachment, $user]);
        
        $attachment->delete();

        return response()->noContent();
    }
}
