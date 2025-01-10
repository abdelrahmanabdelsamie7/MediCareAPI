<?php
namespace App\Http\Controllers\API;
use App\Models\Pharmacy;
use App\Models\UserPharmacy;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPharmacyRequest;

class UserPharmacyController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only('destroy');
        $this->middleware('auth:api')->only('store');
    }
    public function index()
    {
        $ratingsOfPharmacy = UserPharmacy::all();
        return $this->sendSuccess('Ratings of Pharmacy Retrieved Successfully!', $ratingsOfPharmacy);
    }
    public function store(UserPharmacyRequest $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['message' => 'You are not authorized'], 403);
        }

        $validated = $request->validated();
        $pharmacyId = $validated['pharmacy_id'];

        $existingUserPharmacy = UserPharmacy::where('user_id', $userId)
            ->where('pharmacy_id', $pharmacyId)
            ->first();

        if ($existingUserPharmacy) {
            return response()->json(['message' => 'You have already rated this pharmacy'], 400);
        }

        try {
            $userPharmacy = UserPharmacy::create([
                'user_id' => $userId,
                'pharmacy_id' => $pharmacyId,
                'review' => $validated['review'],
                'rating_value' => $validated['rating_value'],
            ]);
            $avgRating = UserPharmacy::where('pharmacy_id', $pharmacyId)->avg('rating_value');

            // تحديث الصيدلية
            $pharmacy = Pharmacy::find($pharmacyId);
            if (!$pharmacy) {
                return response()->json(['message' => 'Pharmacy not found'], 404);
            }

            $pharmacy->avg_rate = round($avgRating, 2);
            $pharmacy->save();

            return response()->json([
                'message' => 'Thank you for your review!',
                'avgRate' => $pharmacy->avg_rate,
                'data' => $userPharmacy
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while adding the review. Please try again later.'], 500);
        }
    }
    public function show(string $id)
    {
        $userPharmacy = UserPharmacy::findOrFail($id);
        return $this->sendSuccess('User Pharmacy review Retrieved Successfully!', $userPharmacy);
    }
    public function destroy(string $id)
    {
        $userPharmacy = userPharmacy::findOrFail($id);
        $userPharmacy->delete();
        return $this->sendSuccess('user Rating Deleted Successfully');
    }
}
