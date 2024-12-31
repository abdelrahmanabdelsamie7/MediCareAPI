<?php
namespace App\Http\Controllers\API;
use App\Models\DoctorOfferImage;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorOfferImageRequest;
class DoctorOfferImageController extends Controller
{
    use ResponseJsonTrait;
    public function index()
    {
        $doctor_offer_images = DoctorOfferImage::all();
        return $this->sendSuccess('Doctor Offer Images Retrieved Successfully', $doctor_offer_images);
    }
    public function store(DoctorOfferImageRequest $request)
    {
        $doctor_offer_image = DoctorOfferImage::create($request->validated());
        return $this->sendSuccess('Doctor Offer Image Added Successfully', $doctor_offer_image, 201);
    }
    public function show(string $id)
    {
        $doctor_offer_image = DoctorOfferImage::with('doctor_offer')->findOrFail($id);
        return $this->sendSuccess('Doctor Offer Image Retireved Successfully', $doctor_offer_image);
    }
    public function update(DoctorOfferImageRequest $request, string $id)
    {
        $doctor_offer_image = DoctorOfferImage::findOrFail($id);
        $doctor_offer_image->update($request->validated());
        return $this->sendSuccess('Doctor Offer Image Updated Successfully', $doctor_offer_image, 201);
    }
    public function destroy(string $id)
    {
        $doctor_offer_image = DoctorOfferImage::findOrFail($id);
        $doctor_offer_image->delete();
        return $this->sendSuccess('Doctor Offer Image Deleted Successfully');
    }
}
