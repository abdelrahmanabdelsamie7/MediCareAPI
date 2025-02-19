<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferGroupRequest;
use App\Models\OfferGroup;
use App\Traits\ResponseJsonTrait;
class OfferGroupController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $offerGroups = OfferGroup::all();
        return $this->sendSuccess('Group Of Offers Retrieved Successfully', $offerGroups);
    }
    public function store(OfferGroupRequest $request)
    {
        $offer_group = OfferGroup::create($request->validated());
        return $this->sendSuccess('Group Of Offer Added Successfully', $offer_group, 201);
    }
    public function show(string $id)
    {
        $offer_group = OfferGroup::with(['doctor_offers' , 'doctor_offers.images'])
            ->withCount('doctor_offers')
            ->findOrFail($id);
        return $this->sendSuccess('Group Of Offer Retrieved Successfully', $offer_group);
    }
    public function update(OfferGroupRequest $request, string $id)
    {
        $offer_group = OfferGroup::findOrFail($id);
        $offer_group->update($request->validated());
        return $this->sendSuccess('Group Of Offer Updated Successfully', $offer_group, 201);
    }
    public function destroy(string $id)
    {
        $offer_group = OfferGroup::findOrFail($id);
        $offer_group->delete();
        return $this->sendSuccess('Group Of Offer Deleted Successfully');
    }
}