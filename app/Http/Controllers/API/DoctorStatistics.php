<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class DoctorStatistics extends Controller
{
    public function getStatistics()
    {
        $doctor = Auth::guard('doctors')->user();
        if (!$doctor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $statistics = [
            'blogs_count' => $doctor->blogs()->count(),
            'offers_count' => $doctor->doctor_offers()->count(),
            'reservations_count' => $doctor->reservations()->count(),
            'clinics_count' => $doctor->clinics()->count(),
            'appointments_count' => $doctor->appointments()->count(),
        ];
        return response()->json([
            'message' => 'Doctor Statistics Retrieved Successfully',
            'data' => $statistics,
        ]);
    }
}
