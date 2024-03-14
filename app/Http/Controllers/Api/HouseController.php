<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreHouseRequest;
use App\Http\Requests\Api\UpdateHouseRequest;
use App\Http\Resources\HouseResource;
use App\Models\House;

class HouseController extends Controller
{
    public function index()
    {
        $houses = House::paginate(10);

        return HouseResource::collection($houses);
    }

    public function store(StoreHouseRequest $request)
    {
        $house = House::create($request->validated());

        return new HouseResource($house);
    }

    public function show(House $house)
    {
        return new HouseResource($house);
    }

    public function update(UpdateHouseRequest $request, House $house)
    {
        $house->update($request->validated());

        return new HouseResource($house);
    }

    public function destroy(House $house)
    {
        $house->delete();

        return response()->noContent();
    }
}
