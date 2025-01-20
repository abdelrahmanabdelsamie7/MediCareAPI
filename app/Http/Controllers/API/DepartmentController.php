<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Traits\ResponseJsonTrait;
class DepartmentController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $departments = Department::all();
        return $this->sendSuccess('Departments Retrieved Successfully', $departments);
    }
    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        return $this->sendSuccess('Department Added Successfully', $department, 201);
    }
    public function show(string $id)
    {
        $department = Department::with('hospitals', 'care_centers', 'doctors')->findOrFail($id);
        $uniqueHospitals = $department->hospitals->unique('id')->values();
        $department->setRelation('hospitals', $uniqueHospitals);
        return $this->sendSuccess('Department Retrieved Successfully', new DepartmentResource($department));
    }
    public function update(DepartmentRequest $request, string $id)
    {
        $department = Department::findOrFail($id);
        $department->update($request->validated());
        return $this->sendSuccess('Department Updated Successfully', $department, 201);
    }
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return $this->sendSuccess('Department Deleted Successfully');
    }
}
