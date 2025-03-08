<?php
namespace App\Http\Controllers\API;
use App\Models\CareCenter;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class CareCenter_DepartmentController extends Controller
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
            'care_center_id' => 'required|exists:care_centers,id',
            'app_price' => 'required|numeric',
            'start_at' => 'date_format:H:i',
            'end_at' => 'date_format:H:i',
        ]);
        $department = Department::find($validated['department_id']);
        $care_Center = CareCenter::find($validated['care_center_id']);
        $department->care_centers()->attach($care_Center, [
            'app_price' => $validated['app_price'],
            'start_at' => $validated['start_at'],
            'end_at' => $validated['end_at'],
        ]);
        return $this->sendSuccess('Department linked to CareCenter successfully');
    }
    public function update(Request $request, $departmentId, $careCenterId)
    {
        $validated = $request->validate([
            'app_price' => 'required|numeric',
            'start_at' => 'date_format:H:i:s',
            'end_at' => 'date_format:H:i:s',
        ]);
        $department = Department::findOrFail($departmentId);
        $care_center = CareCenter::findOrFail($careCenterId);
        if ($department->care_centers()->where('care_center_id', $careCenterId)->exists()) {
            $department->care_centers()->updateExistingPivot($careCenterId, [
                'app_price' => $validated['app_price'],
                'start_at' => $validated['start_at'],
                'end_at' => $validated['end_at'],
            ]);
        } else {
            $department->care_centers()->attach($careCenterId, [
                'app_price' => $validated['app_price'],
                'start_at' => $validated['start_at'],
                'end_at' => $validated['end_at'],
            ]);
        }
        return $this->sendSuccess('Department-CareCenter relation updated successfully');
    }
}