<?php
namespace App\Http\Controllers\API;
use App\Http\Resources\PharmacyResource;
use App\Models\Pharmacy;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyRequest;
use Illuminate\Http\Request;
class PharmacyController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index(Request $request)
    {   \Log::info('Request Parameters:', $request->all());
        $query = Pharmacy::query();

        // 1. Search Implementation
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('service', 'like', "%{$searchTerm}%")
                    ->orWhere('city', 'like', "%{$searchTerm}%")
                    ->orWhere('area', 'like', "%{$searchTerm}%")
                     ->orWhere('phone', 'like', "%{$searchTerm}%");
            });
        }

        // 2. Filter Implementation
        if ($request->has('deliveryOption') && $request->deliveryOption != 'all') {
            $deliveryOption = $request->deliveryOption === '1' ? 1 : 0;
             $query->where('deliveryOption',  $deliveryOption);
        }

        if ($request->has('insurence') && $request->insurence != 'all') {
            $insurence = $request->insurence === '1' ? 1 : 0;
            $query->where('insurence', $insurence);
        }

       if ($request->has('min_rate')) {
            $query->where('avg_rate', '>=', $request->min_rate);
        }

       if ($request->has('chain_pharmacy_id') && $request->chain_pharmacy_id != 'all') {
           $query->where('chain_pharmacy_id', $request->chain_pharmacy_id);
        }
        if ($request->has('city') && $request->city !== 'all') {
            $query->where('city', 'like', "%{$request->city}%");
        }
         if ($request->has('area') && $request->area !== 'all') {
            $query->where('area', 'like', "%{$request->area}%");
        }


        // 3. Pagination
        $pharmacies = $query->paginate(5);

        return $this->sendSuccess('Pharmacies Retrieved Successfully', $pharmacies);
    }
    public function store(PharmacyRequest $request)
    {
        $pharmacy = Pharmacy::create($request->validated());
        return $this->sendSuccess('Pharmacy Added Successfully', $pharmacy, 201);
    }
    public function show(string $id)
    {
        $pharmacy = Pharmacy::with('users')->findOrFail($id);

        return $this->sendSuccess('Pharmacy Retireved Successfully', $pharmacy);
    }
    public function update(PharmacyRequest $request, string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update($request->validated());
        return $this->sendSuccess('Pharmacy Updated Successfully', $pharmacy, 201);
    }
    public function destroy(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();
        return $this->sendSuccess('Pharmacy Deleted Successfully');
    }
}
