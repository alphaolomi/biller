<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HouseBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(House $house)
    {
        $user = auth()->user();

        Gate::authorize('viewAny', [$house, $user]);

        $bill = $house->bills()
            ->with('attachments')
            ->where('user_id', $user->id)
            ->paginate(10);

        return new BillResource($bill);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(House $house, Request $request)
    {

        $user = auth()->user();

        Gate::authorize('create', [$house, $user]);

        $bill = $house->bills()->create($request->all());

        return new BillResource($bill);
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house, string $id)
    {

        $user = auth()->user();

        Gate::authorize('view', [$house, $user]);

        $bill = $house->bills()->findOrFail($id);

        return new BillResource($bill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house, string $id)
    {

        $user = auth()->user();

        Gate::authorize('update', [$house, $user]);

        $bill = $house->bills()->findOrFail($id);
        $bill->update($request->all());

        return new BillResource($bill);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house, string $id)
    {

        $user = auth()->user();

        Gate::authorize('delete', [$house, $user]);

        $bill = $house->bills()->findOrFail($id);
        $bill->delete();

        return response()->noContent();
    }
}
