<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate Google token
        $request->validate(['token' => 'required|string']);

        // Verify Google ID token
        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($request->token);

        // Token validation check
        if (!$payload || $payload['aud'] !== env('GOOGLE_CLIENT_ID')) {
            return response()->json(['error' => 'Invalid Google token'], 401);
        }
        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $payload['email']],
            [
                'name' => $payload['name'],
                'google_id' => $payload['sub'],
                'avatar' => $payload['picture']??null,
            ]
        );

        // Generate JWT token
        $token = auth('api')->login($user);

        return response()->json([
            'access_token' => $token,
            'user' => $user
        ]);
    }
}
