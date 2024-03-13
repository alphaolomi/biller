<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show()
    {
        return response()->json(auth()->user());
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->update($validated);

        return response()->json($user);
    }
}
