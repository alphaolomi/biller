<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreHouseRequest;
use App\Http\Requests\Api\UpdateHouseRequest;
use App\Http\Resources\HouseResource;
use App\Models\House;
use Illuminate\Support\Facades\Gate;

class HouseController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', House::class);

        $houses = House::paginate(10);

        return HouseResource::collection($houses);
    }

    public function store(StoreHouseRequest $request)
    {
        Gate::authorize('create', House::class);

        $data = $request->validated();
        
        $data['user_id'] = auth()->id();

        $house = House::create($data);

        return new HouseResource($house);
    }

    public function show(House $house)
    {
        $user = auth()->user();

        Gate::authorize('view', [$house, $user]);

        return new HouseResource($house);
    }

    public function update(UpdateHouseRequest $request, House $house)
    {
        $user = auth()->user();

        Gate::authorize('update', [$house, $user]);

        $house->update($request->validated());

        return new HouseResource($house);
    }

    public function destroy(House $house)
    {
        $user = auth()->user();

        Gate::authorize('delete', [$house, $user]);

        $house->delete();

        return response()->noContent();
    }
}
