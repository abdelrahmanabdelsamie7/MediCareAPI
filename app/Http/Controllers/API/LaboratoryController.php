<?php
namespace App\Http\Controllers\API;
use App\Models\Laboratory;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\LaboratoryRequest;
use App\Http\Resources\LaboratoryResource;
use Illuminate\Http\Request;
class LaboratoryController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index(Request $request)
    {
        \Log::info('Request Parameters:', $request->all());
        $query = Laboratory::query();
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('service', 'like', "%{$searchTerm}%")
                    ->orWhere('city', 'like', "%{$searchTerm}%")
                    ->orWhere('insurence', $searchTerm)
                    ->orWhere('area', 'like', "%{$searchTerm}%")
                    ->orWhere('phone', 'like', "%{$searchTerm}%");
            });
        }
        if ($request->has('insurence') && $request->insurence != 'all') {
            $insurence = $request->insurence === '1' ? 1 : 0;
            $query->where('insurence', $insurence);
        }
        if ($request->has('min_rate')) {
            $query->where('avg_rate', '>=', $request->min_rate);
        }
        if ($request->has('chain_laboratory_id') && $request->chain_laboratory_id != 'all') {
            $query->where('chain_laboratory_id', $request->chain_laboratory_id);
        } else if ($request->has('chain_laboratory_id') && $request->chain_laboratory_id == 'all') {
            $query->where(function ($q) {
                $q->where('chain_laboratory_id', null)
                    ->orWhereNotNull('chain_laboratory_id');
            });
        }
        if ($request->has('city') && $request->city !== 'all') {
            $query->where('address', 'like', "%{$request->city}%");
        }
        if ($request->has('area') && $request->area !== 'all') {
            $query->where('address', 'like', "%{$request->area}%");
        }
        $laboratories = $query->paginate(6);
        return $this->sendSuccess('Laboratories Retrieved Successfully', $laboratories);
    }
    public function store(LaboratoryRequest $request)
    {
        $laboratory = Laboratory::create($request->validated());
        return $this->sendSuccess('Laboratory Added Successfully', $laboratory, 201);
    }
    public function show(string $id)
    {
        $laboratory = Laboratory::with('users')->findOrFail($id);
        return $this->sendSuccess('Laboratory Retireved Successfully', $laboratory);
    }
    public function update(LaboratoryRequest $request, string $id)
    {
        $laboratory = Laboratory::findOrFail($id);
        $laboratory->update($request->validated());
        return $this->sendSuccess('Laboratory Updated Successfully', new LaboratoryResource($laboratory), 201);
    }
    public function destroy(string $id)
    {
        $laboratory = Laboratory::findOrFail($id);
        $laboratory->delete();
        return $this->sendSuccess('Laboratory Deleted Successfully');
    }
}