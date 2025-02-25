<?php
namespace App\Http\Controllers\API;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['index', 'show', 'destroy']);
    }
    public function index()
    {
        $users = User::all();
        return response()->json([
            "message" => "All Of Users Retrieved Successfully ",
            "data" => $users,
            "count" => User::count()
        ], 200);
    }
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            "message" => "User Retrieved Successfully ",
            "data" => $user,
        ], 200);
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            "message" => "User Retrieved Successfully ",
            "data" => $user,
        ], 200);
    }
    public function getProgress()
    {
        $user = Auth::user();
        return response()->json([
            'points' => $user->points,
            'last_visit' => $user->last_visit,
        ]);
    }
    public function redeem(Request $request)
    {
        $user = Auth::user();
        $requiredPoints = 200;

        if ($user->points >= $requiredPoints) {
            $user->points -= $requiredPoints;
            $user->save();
            return response()->json(['message' => 'تم استبدال النقاط بنجاح!']);
        }

        return response()->json(['message' => 'النقاط غير كافية.'], 400);
    }
}