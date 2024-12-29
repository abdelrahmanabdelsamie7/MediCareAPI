<?php
namespace App\Http\Controllers\API;
use App\Models\Specialization;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationRequest;
class SpecializationController extends Controller
{
    use ResponseJsonTrait;
    public function index()
    {
        $specializations = Specialization::all();
        return $this->sendSuccess('Specializations Retrieved Successfully', $specializations);
    }
    public function store(SpecializationRequest $request)
    {
        $specialization = Specialization::create($request->validated());
        return $this->sendSuccess('Specialization Added Successfully', $specialization, 201);
    }
    public function show(string $id)
    {
        $specialization = Specialization::with('doctors')->findOrFail($id);
        return $this->sendSuccess('Specialization Retrieved Successfully', $specialization);
    }
    public function update(SpecializationRequest $request, string $id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->update($request->validated());
        return $this->sendSuccess('Specialization Updated Successfully', $specialization, 201);
    }
    public function destroy(string $id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->delete();
        return $this->sendSuccess('Specialization Removed Successfully');
    }
}
