<?php

namespace App\Http\Controllers\API;

use App\Models\Hospital;
use App\Models\Department;
use App\Traits\ResponseJsonTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Department_HospitalController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update']);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'hospital_id' => 'required|exists:hospitals,id',
            'app_price' => 'required|numeric',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);
        $department = Department::find($validated['department_id']);
        $hospital = Hospital::find($validated['hospital_id']);
        $department->hospitals()->attach($hospital, [
            'app_price' => $validated['app_price'],
            'start_at' => $validated['start_at'],
            'end_at' => $validated['end_at'],
        ]);
        return $this->sendSuccess('Department linked to Hospital successfully');
    }
    public function update(Request $request, $departmentId, $hospitalId)
    {
        $validated = $request->validate([
            'app_price' => 'required|numeric',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);
        $department = Department::findOrFail($departmentId);
        $hospital = Hospital::findOrFail($hospitalId);
        if ($department->hospitals()->where('hospital_id', $hospitalId)->exists()) {
            $department->hospitals()->updateExistingPivot($hospitalId, [
                'app_price' => $validated['app_price'],
                'start_at' => $validated['start_at'],
                'end_at' => $validated['end_at'],
            ]);
        } else {
            $department->hospitals()->attach($hospitalId, [
                'app_price' => $validated['app_price'],
                'start_at' => $validated['start_at'],
                'end_at' => $validated['end_at'],
            ]);
        }
        return $this->sendSuccess('Department-Hospital relation updated successfully');
    }
}
