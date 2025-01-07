<?php
namespace App\Http\Controllers\API;
use App\Models\Doctor;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DoctorUpdateRequest;

class DoctorController extends Controller
{
    use ResponseJsonTrait;

    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
        $this->middleware('auth:doctors')->only(['show', 'update']);
    }
    public function index()
    {
        $doctors = Doctor::all();
        return $this->sendSuccess('Doctors Retrieved Successfully', $doctors);
    }
    public function store(DoctorRequest $request)
    {
        $doctor = Doctor::create($request->validated());
        return $this->sendSuccess('Doctor Added Successfully', $doctor, 201);
    }
    public function show(string $id)
    {
        $doctor = Doctor::with('department', 'specializations', 'doctor_offers', 'clinics')->findOrFail($id);
        if (Auth::guard('doctors')->id() != $doctor->id) {
            return $this->sendError('Unauthorized', [], 403);
        }
        return $this->sendSuccess('Doctor Retrieved Successfully', $doctor);
    }
    public function update(DoctorUpdateRequest $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        if (Auth::guard('doctors')->id() != $doctor->id) {
            return $this->sendError('Unauthorized', [], 403);
        }

        $doctor->update($request->validated());
        return $this->sendSuccess('Doctor Updated Successfully', $doctor, 201);
    }
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return $this->sendSuccess('Doctor Deleted Successfully');
    }
}
