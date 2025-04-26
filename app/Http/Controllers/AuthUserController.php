<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Mail\ResetPassword;
class AuthUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verifyEmail', 'resendVerification', 'forgotPassword', 'resetPassword']]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        if (!$user->email_verified_at) {
            return response()->json(['error' => 'Please verify your email before logging in.'], 403);
        }
        $token = auth('api')->login($user);

        $now = Carbon::now();
        if (!$user->last_visit || $now->diffInHours($user->last_visit) >= 24) {
            $user->points += 10;
            $user->last_visit = $now;
            $user->save();
        }
        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح!',
            'access_token' => $token,
            'points' => $user->points,
            'last_visit' => $user->last_visit,
            'user' => $user
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|min:8|max:15|regex:/^[0-9]+$/',
            "address" => 'required|string',
            "birth_date" => 'required|date|before:today',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $verificationToken = Str::random(60);
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            "address" => $request->get('address'),
            "birth_date" => $request->get('birth_date'),
            'password' => Hash::make($request->get('password')),
            'verification_token' => $verificationToken,
            'verification_token_expires_at' => now()->addMinutes(30),
        ]);

        Mail::to($user->email)->queue(new VerifyEmail($user));


        return response()->json([
            'message' => 'User registered successfully. Please check your email to verify your account.',
        ], 201);
    }
    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)
            ->where('verification_token_expires_at', '>', now()) //  Check expiration
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid or expired verification token'], 400);
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->verification_token_expires_at = null;
        $user->save();

        return redirect('http://localhost:4200/Login')->with('message', 'Email verified successfully. You can now log in.');
    }
    public function resendVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email is already verified.'], 200);
        }

        //  Regenerate verification token
        $user->verification_token = Str::random(60);
        $user->verification_token_expires_at = now()->addMinutes(30);
        $user->save();

        // reSend verification email
        Mail::to($user->email)->queue(new VerifyEmail($user));


        return response()->json(['message' => 'Verification email has been resent.']);
    }
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)->first();
        $token = Str::random(60);

        // Store the reset token in the users table
        $user->reset_token = $token;
        $user->reset_token_expires_at = now()->addHour(); // Token expires in 1 hour
        $user->save();

        try {
            Mail::to($user->email)->queue(new ResetPassword($user, $token));
        } catch (\Exception $e) {
            \Log::error('Password reset email failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send reset email.'], 500);
        }

        return response()->json(['message' => 'Password reset link sent to your email.'], 200);
    }
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->where('reset_token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid or expired reset token.'], 400);
        }

        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->reset_token_expires_at = null;
        $user->save();

        return response()->json(['message' => 'Password reset successfully.'], 200);
    }
    public function getaccount()
    {
        return response()->json(auth('api')->user());
    }
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function deleteAccount(Request $request)
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if user logged in with OAuth (google_id exists)
        $isOAuthUser = !empty($user->google_id);

        if (!$isOAuthUser) {
            // Password-based user: require and verify password
            $validator = Validator::make($request->all(), [
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Incorrect password'], 401);
            }
        }

        // Logout and delete user (works for both OAuth and password users)
        auth('api')->logout();
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully.'], 200);
    }
    public function updateProfile(Request $request)
{
    $user = auth('api')->user(); // Get the authenticated user

    // Validation for the inputs
    $validator = Validator::make($request->all(), [
        'phone' => 'sometimes|required|string|min:8|max:15|regex:/^[0-9]+$/',
        'address' => 'sometimes|required|string',
        'birth_date' => 'sometimes|required|date|before:today',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Update the fields if they are provided
    if ($request->has('phone')) {
        $user->phone = $request->get('phone');
    }

    if ($request->has('address')) {
        $user->address = $request->get('address');
    }

    if ($request->has('birth_date')) {
        $user->birth_date = $request->get('birth_date');
    }

    $user->save(); // Save the updated user details

    return response()->json([
        'message' => 'Profile updated successfully.',
        'user' => $user
    ]);
}

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 120
        ]);
    }
}
