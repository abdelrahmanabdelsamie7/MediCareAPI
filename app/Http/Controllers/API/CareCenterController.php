<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\CareCenterRequest;
use App\Models\CareCenter;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
class CareCenterController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $care_centers = CareCenter::all();
        return $this->sendSuccess('CareCenters Retrieved Successfully', $care_centers);
    }
    public function store(CareCenterRequest $request)
    {
        $care_Center = CareCenter::create($request->validated());
        return $this->sendSuccess('CareCenter Added Successfully', $care_Center, 201);
    }
    public function show(string $id)
    {
        $care_Center = CareCenter::with('departments')->findOrFail($id);
        return $this->sendSuccess('CareCenter Retireved Successfully', $care_Center);
    }
    public function update(CareCenterRequest $request, string $id)
    {
        $care_Center = CareCenter::findOrFail($id);
        $care_Center->update($request->validated());
        return $this->sendSuccess('CareCenter Updated Successfully', $care_Center, 201);
    }
    public function destroy(string $id)
    {
        $care_Center = CareCenter::findOrFail($id);
        $care_Center->delete();
        return $this->sendSuccess('CareCenter Deleted Successfully');
    }
}
