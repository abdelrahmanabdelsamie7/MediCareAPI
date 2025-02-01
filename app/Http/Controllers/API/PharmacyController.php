<?php
namespace App\Http\Controllers\API;
use App\Http\Resources\PharmacyResource;
use App\Models\Pharmacy;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyRequest;

class PharmacyController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $pharmacies = Pharmacy::paginate(10);
        return $this->sendSuccess('Pharmacies Retrieved Successfully', [
            'pharmacies' => PharmacyResource::collection($pharmacies),
            'pagination' => [
                'current_page' => $pharmacies->currentPage(),
                'total' => $pharmacies->total(),
                'num_of_pages' => $pharmacies->lastPage(),
            ],
        ]);
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
