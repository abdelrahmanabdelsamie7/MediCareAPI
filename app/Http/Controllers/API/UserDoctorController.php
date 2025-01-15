<?php
namespace App\Http\Controllers\API;
use App\Models\Doctor;
use App\Models\UserDoctor;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserDoctorRequest;

class UserDoctorController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only('destroy');
        $this->middleware('auth:api')->only('store');
    }
    public function index()
    {
        $ratingsOfDoctor = UserDoctor::all();
        return $this->sendSuccess('Ratings of Doctor Retrieved Successfully!', $ratingsOfDoctor);
    }
    public function store(UserDoctorRequest $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['message' => 'You are not authorized'], 403);
        }
        $validated = $request->validated();
        $doctorId = $validated['doctor_id'];
        $existingUserDoctor = UserDoctor::where('user_id', $userId)
            ->where('doctor_id', $doctorId)
            ->first();

        if ($existingUserDoctor) {
            return response()->json(['message' => 'You have already rated this Doctor'], 400);
        }

        try {
            $UserDoctor = UserDoctor::create([
                'user_id' => $userId,
                'doctor_id' => $doctorId,
                'review' => $validated['review'],
                'rating_value' => $validated['rating_value'],
            ]);
            $avgRating = UserDoctor::where(
                'doctor_id',
                $doctorId
            )->avg('rating_value');

            $doctor = Doctor::find($doctorId);
            if (!$doctor) {
                return response()->json(['message' => 'Doctor not found'], 404);
            }
            $doctor->avg_rate = round($avgRating, 2);
            $doctor->save();

            return response()->json([
                'message' => 'Thank you for your review!',
                'avgRate' => $doctor->avg_rate,
                'data' => $UserDoctor
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while adding the review. Please try again later.'], 500);
        }
    }
    public function show(string $id)
    {
        $UserDoctor = UserDoctor::findOrFail($id);
        return $this->sendSuccess('User Doctor review Retrieved Successfully!', $UserDoctor);
    }
    public function destroy(string $id)
    {
        $UserDoctor = UserDoctor::findOrFail($id);
        $UserDoctor->delete();
        return $this->sendSuccess('user Rating Deleted Successfully');
    }
}
