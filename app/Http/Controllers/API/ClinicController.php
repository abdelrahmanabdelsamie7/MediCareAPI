<?php
namespace App\Http\Controllers\API;
use App\Models\Clinic;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;

class ClinicController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $clinics = Clinic::all();
        return $this->sendSuccess('Clinics Retrieved Successfully', $clinics);
    }
    public function store(ClinicRequest $request)
    {
        $clinic = Clinic::create($request->validated());
        return $this->sendSuccess('Clinic Added Successfully', $clinic, 201);
    }
    public function show(string $id)
    {
        $clinic = Clinic::with('images')->findOrFail($id);
        return $this->sendSuccess('Clinic Retireved Successfully', $clinic);
    }
    public function update(ClinicRequest $request, string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->update($request->validated());
        return $this->sendSuccess('Clinic Updated Successfully', $clinic, 201);
    }
    public function destroy(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();
        return $this->sendSuccess('Clinic Deleted Successfully');
    }
}
