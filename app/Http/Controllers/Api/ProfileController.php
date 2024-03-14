<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        Gate::authorize('show-profile', $user);

        return response()->json(auth()->user());
    }

    public function update(Request $request)
    {

        $user = auth()->user();

        Gate::authorize('edit-profile', $user);
        
        $validated = $request->validate([
            'name' => 'nullable|string',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->update($validated);

        return response()->json($user);
    }
}
