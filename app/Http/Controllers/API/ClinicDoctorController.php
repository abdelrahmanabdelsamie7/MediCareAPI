<?php
namespace App\Http\Controllers\API;
use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class ClinicDoctorController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'destroy']);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'clinic_id' => 'required|exists:clinics,id',
        ]);

        $doctor = Doctor::find($validated['doctor_id']);
        $clinic = Clinic::find($validated['clinic_id']);
        if (!$doctor->clinics->contains($clinic->id)) {
            $doctor->clinics()->attach($clinic);
            return $this->sendSuccess('Clinic linked to Doctor successfully');
        }
        return $this->sendError('Doctor is already linked to this clinic');
    }
    public function destroy($doctorId, $clinicId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $clinic = Clinic::findOrFail($clinicId);
        if ($doctor->clinics()->where('clinic_id', $clinicId)->exists()) {
            $doctor->clinics()->detach($clinicId);
            return $this->sendSuccess('Doctor-Clinic relation deleted successfully');
        }
        return $this->sendError('Doctor is not linked to this clinic');
    }
}
