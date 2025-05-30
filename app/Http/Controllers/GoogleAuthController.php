<?php

namespace App\Http\Controllers;

use Google\Client as Google_Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
                'avatar' => $payload['picture'] ?? null,
            ]
        );
        $now = Carbon::now();
        if (!$user->last_visit || $now->diffInHours($user->last_visit) >= 24) {
            $user->increment('points', 10);
            $user->update(['last_visit' => $now]);
        }
        // Generate JWT token
        $token = auth('api')->login($user);
     //   $token = auth('api')->attempt(['email' => $user->email, 'password' => '']);

        return response()->json([
            'access_token' => $token,
            'user' => $user
        ]);
    }
}
