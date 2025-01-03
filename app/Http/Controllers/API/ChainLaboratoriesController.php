<?php
namespace App\Http\Controllers\API;
use App\Models\ChainLaboratories;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChainLaboratoriesRequest;
use App\Http\Resources\ChainLaboratoryResource;

class ChainLaboratoriesController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $chain_laboratories = ChainLaboratories::all();
        return $this->sendSuccess('Chain Laboratories Retrieved Successfully', $chain_laboratories);
    }
    public function store(ChainLaboratoriesRequest $request)
    {
        $ChainLaboratories = ChainLaboratories::create($request->validated());
        return $this->sendSuccess('Chain Laboratories Added Successfully', $ChainLaboratories, 201);
    }
    public function show(string $id)
    {
        $ChainLaboratories = ChainLaboratories::with('laboratories')->findOrFail($id);
        return $this->sendSuccess('Chain Laboratories Retireved Successfully', new ChainLaboratoryResource($ChainLaboratories));
    }
    public function update(ChainLaboratoriesRequest $request, string $id)
    {
        $ChainLaboratories = ChainLaboratories::findOrFail($id);
        $ChainLaboratories->update($request->validated());
        return $this->sendSuccess('Chain Laboratories Updated Successfully', new ChainLaboratoryResource($ChainLaboratories), 201);
    }
    public function destroy(string $id)
    {
        $ChainLaboratories = ChainLaboratories::findOrFail($id);
        $ChainLaboratories->delete();
        return $this->sendSuccess('Chain Laboratories Deleted Successfully');
    }
}
