<?php
namespace App\Http\Controllers\API;
use App\Models\DeliveryService;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryServiceRequest;

class DeliveryServiceController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $delivery_services = DeliveryService::all();
        return $this->sendSuccess('Delivery Services Retrieved Successfully', $delivery_services);
    }
    public function store(DeliveryServiceRequest $request)
    {
        $delivery_service = DeliveryService::create($request->validated());
        return $this->sendSuccess('Delivery Service Added Successfully', $delivery_service, 201);
    }
    public function show(string $id)
    {
        $delivery_service = DeliveryService::findOrFail($id);
        return $this->sendSuccess('Delivery Service Retrieved Successfully', $delivery_service);
    }
    public function update(DeliveryServiceRequest $request, string $id)
    {
        $delivery_service = DeliveryService::findOrFail($id);
        $delivery_service->update($request->validated());
        return $this->sendSuccess('Delivery Service Updated Successfully', $delivery_service, 201);
    }
    public function destroy(string $id)
    {
        $delivery_service = DeliveryService::findOrFail($id);
        $delivery_service->delete();
        return $this->sendSuccess('Delivery Service Deleted Successfully');
    }
}
