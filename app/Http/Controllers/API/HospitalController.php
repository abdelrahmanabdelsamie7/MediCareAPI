<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\HospitalRequest;
use App\Models\Hospital;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class HospitalController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $hospitals = Hospital::all();
        return $this->sendSuccess('Hospitals Retrieved Successfully', $hospitals);
    }
    public function store(HospitalRequest $request)
    {
        $hospital = Hospital::create($request->validated());
        return $this->sendSuccess('Hospital Added Successfully', $hospital, 201);
    }
    public function show(string $id)
    {
        $hospital = Hospital::with('departments')->findOrFail($id);
        return $this->sendSuccess('Hospital Retireved Successfully', $hospital);
    }
    public function update(HospitalRequest $request, string $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update($request->validated());
        return $this->sendSuccess('Hospital Updated Successfully', $hospital, 201);
    }
    public function destroy(string $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();
        return $this->sendSuccess('Hospital Deleted Successfully');
    }
}
