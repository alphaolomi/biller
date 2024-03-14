<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'nullable|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $tokenName = $request->device_name ?? 'token';
        $defaultAbilities = ['*'];
        $expiresAt = now()->addWeek();

        $token = $user->createToken(
            $tokenName,
            $defaultAbilities,
            $expiresAt
        )->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        $validated = $request->validate(['token_id' => 'nullable|string']);

        if (isset($validated['token_id'])) {
            // Revoke the token that was used to authenticate the current request...
            $request->user()->tokens()->where('id', $validated['token_id'])->delete();
        } else {
            // Revoke the token that was used to authenticate the current request...
            /** @var \Laravel\Sanctum\PersonalAccessToken $accessToken */
            $accessToken = $request->user()->currentAccessToken();

            $accessToken->delete();
        }

        return response([
            'message' => 'Logged out',
        ]);
    }

    // logout from all devices
    public function logoutFromAllDevices(Request $request)
    {
        // Revoke all of the user's tokens...
        $request->user()->tokens()->delete();

        return response([
            'message' => 'Logged out from all devices',
        ]);
    }
}
