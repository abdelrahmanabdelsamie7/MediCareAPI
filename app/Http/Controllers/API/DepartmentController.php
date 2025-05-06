<?php
namespace App\Http\Controllers\API;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;

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
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }
        $departments = $query->paginate(20);
        return $this->sendSuccess('Departments Retrieved Successfully', $departments, );
    }
    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        return $this->sendSuccess('Department Added Successfully', $department, 201);
    }
    public function show(Request $request, string $id)
    {
        $department = Department::withCount(['hospitals', 'care_centers', 'doctors'])
            ->findOrFail($id);
        $filter = $request->query('filter');
        $page = $request->query('page', 1);
        $response = [
            'department' => new DepartmentResource($department),
            'hospitals_count' => $department->hospitals_count,
            'care_centers_count' => $department->care_centers_count,
            'doctors_count' => $department->doctors_count,
        ];
        if (!$filter || $filter === 'hospitals') {
            $hospitals = $department->hospitals()->paginate(6, ['*'], 'hospitals_page', $page);
            $response['hospitals'] = [
                'current_page' => $hospitals->currentPage(),
                'num_of_pages' => $hospitals->lastPage(),
                'total' => $hospitals->total(),
                'data' => $hospitals->items(),
            ];
        }
        if (!$filter || $filter === 'care_centers') {
            $careCenters = $department->care_centers()->paginate(6, ['*'], 'care_centers_page', $page);
            $response['care_centers'] = [
                'current_page' => $careCenters->currentPage(),
                'num_of_pages' => $careCenters->lastPage(),
                'total' => $careCenters->total(),
                'data' => $careCenters->items(),
            ];
        }

        if (!$filter || $filter === 'doctors') {
            $doctors = $department->doctors()->paginate(6, ['*'], 'doctors_page', $page);
            $response['doctors'] = [
                'current_page' => $doctors->currentPage(),
                'num_of_pages' => $doctors->lastPage(),
                'total' => $doctors->total(),
                'data' => $doctors->items(),
            ];
        }

        $tips = $department->tips()->get();
        $response['tips'] = $tips;

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
