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
class AuthUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verifyEmail', 'resendVerification']]);
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
            'verification_token_expires_at' => now()->addHours(3), 
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

        return response()->json(['message' => 'Email verified successfully. You can now log in.']);
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
        $user->verification_token_expires_at = now()->addHours(3);
        $user->save();

        // reSend verification email
        Mail::to($user->email)->queue(new VerifyEmail($user));


        return response()->json(['message' => 'Verification email has been resent.']);
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
