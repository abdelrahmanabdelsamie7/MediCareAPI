<?php
namespace App\Http\Controllers\API;
use App\Models\DoctorOffer;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Requests\DoctorOfferRequest;
class DoctorOfferController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:doctors')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $doctor_offers = DoctorOffer::where('doctor_id', auth('doctors')->id())->get();
        return $this->sendSuccess('Doctor Offers Retrieved Successfully', $doctor_offers);
    }
    public function store(DoctorOfferRequest $request)
    {
        $doctor_offer = DoctorOffer::create(array_merge(
            $request->validated(),
            ['doctor_id' => auth('doctors')->id()]
        ));
        return $this->sendSuccess('Doctor Offer Added Successfully', $doctor_offer, 201);
    }
    public function show(string $id)
    {
        $doctor_offer = DoctorOffer::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->with(['doctor', 'images'])
            ->firstOrFail();

        return $this->sendSuccess('Doctor Offer Retrieved Successfully', new OfferResource($doctor_offer));
    }
    public function update(DoctorOfferRequest $request, string $id)
    {
        $doctor_offer = DoctorOffer::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->firstOrFail();
        $doctor_offer->update($request->validated());
        return $this->sendSuccess('Doctor Offer Updated Successfully', $doctor_offer);
    }
    public function destroy(string $id)
    {
        $doctor_offer = DoctorOffer::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->firstOrFail();
        $doctor_offer->delete();
        return $this->sendSuccess('Doctor Offer Deleted Successfully');
    }
}
