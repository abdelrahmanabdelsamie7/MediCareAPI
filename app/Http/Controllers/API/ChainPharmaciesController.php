<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\ChainPharmaciesRequest;
use App\Http\Resources\ChainPharmacyResource;
use App\Models\ChainPharmacies;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
class ChainPharmaciesController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $chain_pharmacies = ChainPharmacies::all();
        return $this->sendSuccess('Chain Of Pharmacies Retrieved Successfully', $chain_pharmacies);
    }
    public function store(ChainPharmaciesRequest $request)
    {
        $chain_pharmacy = ChainPharmacies::create($request->validated());
        return $this->sendSuccess('Chain Of Pharmacies Added Successfully', $chain_pharmacy, 201);
    }
    public function show(string $id)
    {
        $chain_pharmacy = ChainPharmacies::findOrFail($id);
        $pharmacies = $chain_pharmacy->pharmacies()->paginate(10);
        $response = [
            'chain_pharmacy' => new ChainPharmacyResource($chain_pharmacy),
            'pharmacies' => [
                'current_page' => $pharmacies->currentPage(),
                'num_of_pages' => $pharmacies->lastPage(),
                'total' => $pharmacies->total(),
                'data' => $pharmacies->items(),
            ],
        ];
        return $this->sendSuccess('Chain Pharmacy Retrieved Successfully', $response);
    }
    public function update(ChainPharmaciesRequest $request, string $id)
    {
        $chain_pharmacy = ChainPharmacies::findOrFail($id);
        $chain_pharmacy->update($request->validated());
        return $this->sendSuccess('Chain Pharmacy Updated Successfully', $chain_pharmacy, 201);
    }
    public function destroy(string $id)
    {
        $chain_pharmacy = ChainPharmacies::findOrFail($id);
        $chain_pharmacy->delete();
        return $this->sendSuccess('Chain Pharmacy Deleted Successfully');
    }
}
