<?php

namespace App\Http\Controllers\API;

use App\Models\Doctor;
use App\Traits\ResponseJsonTrait;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;

class DoctorSpecializationController extends Controller
{

    use ResponseJsonTrait;
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'specialization_id' => 'required|exists:specializations,id',
        ]);
        $doctor = Doctor::find($validated['doctor_id']);
        $specialization = Specialization::find($validated['specialization_id']);
        $doctor->specializations()->attach($specialization);
        return $this->sendSuccess('Specialization Added to Doctor successfully');
    }
    public function destroy($doctorId, $specializationId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        if ($doctor->specializations()->where('specialization_id', $specializationId)->exists()) {
            $doctor->specializations()->detach($specializationId);
            return $this->sendSuccess('Specialization removed from Doctor successfully');
        }
        return $this->sendError('Specialization not found for this Doctor', 404);
    }

}
