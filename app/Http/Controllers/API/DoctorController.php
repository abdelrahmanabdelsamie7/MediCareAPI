<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Doctor;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    use ResponseJsonTrait;
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
        $doctor = Doctor::with('department', 'specializations')->findOrFail($id);
        return $this->sendSuccess('Doctor Retrieved Successfully', $doctor);
    }
    public function update(DoctorUpdateRequest $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->validated());
        return $this->sendSuccess('Doctor Updated Successfully', $doctor, 201);
    }
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return $this->sendSuccess('Doctor Removed Successfully');
    }
}
