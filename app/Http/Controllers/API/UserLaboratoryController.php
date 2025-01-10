<?php
namespace App\Http\Controllers\API;
use App\Models\Laboratory;
use App\Models\UserLaboratory;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserLaboratoryRequest;

class UserLaboratoryController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only('destroy');
        $this->middleware('auth:api')->only('store');
    }
    public function index()
    {
        $ratingsOfLaboratory = UserLaboratory::all();
        return $this->sendSuccess('Ratings of Laboratory Retrieved Successfully!', $ratingsOfLaboratory);
    }
    public function store(UserLaboratoryRequest $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['message' => 'You are not authorized'], 403);
        }
        $validated = $request->validated();
        $laboratoryId = $validated['laboratory_id'];
        $existingUserLaboratory = UserLaboratory::where('user_id', $userId)
            ->where('laboratory_id', $laboratoryId)
            ->first();

        if ($existingUserLaboratory) {
            return response()->json(['message' => 'You have already rated this laboratory'], 400);
        }

        try {
            $UserLaboratory = UserLaboratory::create([
                'user_id' => $userId,
                'laboratory_id' => $laboratoryId,
                'review' => $validated['review'],
                'rating_value' => $validated['rating_value'],
            ]);
            $avgRating = UserLaboratory::where(
                'laboratory_id',
                $laboratoryId
            )->avg('rating_value');

            $laboratory = Laboratory::find($laboratoryId);
            if (!$laboratory) {
                return response()->json(['message' => 'Laboratory not found'], 404);
            }
            $laboratory->avg_rate = round($avgRating, 2);
            $laboratory->save();

            return response()->json([
                'message' => 'Thank you for your review!',
                'avgRate' => $laboratory->avg_rate,
                'data' => $UserLaboratory
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while adding the review. Please try again later.'], 500);
        }
    }
    public function show(string $id)
    {
        $UserLaboratory = UserLaboratory::findOrFail($id);
        return $this->sendSuccess('User Laboratory review Retrieved Successfully!', $UserLaboratory);
    }
    public function destroy(string $id)
    {
        $UserLaboratory = UserLaboratory::findOrFail($id);
        $UserLaboratory->delete();
        return $this->sendSuccess('user Rating Deleted Successfully');
    }
}
