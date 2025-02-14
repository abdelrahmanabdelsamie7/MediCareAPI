<?php
namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins', ['index', 'show', 'destroy']);
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
}
