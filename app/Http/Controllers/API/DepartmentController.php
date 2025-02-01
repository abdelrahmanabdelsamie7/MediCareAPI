<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Traits\ResponseJsonTrait;
class DepartmentController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index(Request $request)
    {
        $query = Department::query();

        // 1. Search Implementation
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // 2. Pagination
        $departments = $query->paginate(10);

        return $this->sendSuccess('Departments Retrieved Successfully', $departments);
     }
    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        return $this->sendSuccess('Department Added Successfully', $department, 201);
    }
    public function show(string $id)
    {
        $department = Department::findOrFail($id);
        $hospitals = $department->hospitals()->paginate(10);
        $careCenters = $department->care_centers()->paginate(10);
        $doctors = $department->doctors()->paginate(1);
        $tips = $department->tips();
        $response = [
            'department' => new DepartmentResource($department),
            'hospitals' => [
                'current_page' => $hospitals->currentPage(),
                'num_of_pages' => $hospitals->lastPage(),
                'total' => $hospitals->total(),
                'data' => $hospitals->items(),
            ],
            'care_centers' => [
                'current_page' => $careCenters->currentPage(),
                'num_of_pages' => $careCenters->lastPage(),
                'total' => $careCenters->total(),
                'data' => $careCenters->items(),
            ],
            'doctors' => [
                'current_page' => $doctors->currentPage(),
                'num_of_pages' => $doctors->lastPage(),
                'total' => $doctors->total(),
                'data' => $doctors->items(),
            ],
            'tips' => [
                'data' => $tips->get(),
            ],
        ];

        return $this->sendSuccess('Department Retrieved Successfully', $response);
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
