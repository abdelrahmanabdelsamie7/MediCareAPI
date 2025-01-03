<?php
namespace App\Http\Controllers\API;
use App\Models\Laboratory;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\LaboratoryRequest;
use App\Http\Resources\LaboratoryResource;
class LaboratoryController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $laboratories = Laboratory::all();
        return $this->sendSuccess('Laboratories Retrieved Successfully', $laboratories);
    }
    public function store(LaboratoryRequest $request)
    {
        $laboratory = Laboratory::create($request->validated());
        return $this->sendSuccess('Laboratory Added Successfully', $laboratory, 201);
    }
    public function show(string $id)
    {
        $laboratory = Laboratory::findOrFail($id);
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
