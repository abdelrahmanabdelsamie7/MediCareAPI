<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\ChainPharmaciesRequest;
use App\Models\ChainPharmacies;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
class ChainPharmaciesController extends Controller
{
    use ResponseJsonTrait;
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
        $chain_pharmacy = ChainPharmacies::with('pharmacies')->findOrFail($id);
        return $this->sendSuccess('Chain Pharmacy Retireved Successfully', $chain_pharmacy);
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
