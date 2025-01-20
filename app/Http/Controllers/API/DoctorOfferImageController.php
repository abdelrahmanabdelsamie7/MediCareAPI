<?php
namespace App\Http\Controllers\API;
use App\Models\DoctorOffer;
use App\Models\DoctorOfferImage;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorOfferImageRequest;

class DoctorOfferImageController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:doctors')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $doctor_offer_images = DoctorOfferImage::whereHas('doctor_offer', function ($query) {
            $query->where('doctor_id', auth('doctors')->id());
        })->get();
        return $this->sendSuccess('Doctor Offer Images Retrieved Successfully', $doctor_offer_images);
    }
    public function store(DoctorOfferImageRequest $request)
    {
        $doctor_offer = DoctorOffer::where('id', $request->doctor_offer_id)
            ->where('doctor_id', auth('doctors')->id())
            ->firstOrFail();
        $doctor_offer_image = DoctorOfferImage::create([
            'doctor_offer_id' => $request->doctor_offer_id,
            'image' => $request->image,
        ]);

        return $this->sendSuccess('Doctor Offer Image Added Successfully', $doctor_offer_image, 201);
    }
    public function show(string $id)
    {
        if (auth('doctors')->check()) {
            $doctor_offer_image = DoctorOfferImage::where('id', $id)
                ->whereHas('doctor_offer', function ($query) {
                    $query->where('doctor_id', auth('doctors')->id());
                })
                ->with('doctor_offer')
                ->firstOrFail();
        } elseif (auth('admins')->check()) {
            $doctor_offer_image = DoctorOfferImage::with('doctor_offer')->findOrFail($id);
        } else {
            return $this->sendError('Unauthorized', [], 403);
        }
        return $this->sendSuccess('Doctor Offer Image Retrieved Successfully', $doctor_offer_image);
    }
    public function update(DoctorOfferImageRequest $request, string $id)
    {
        $doctor_offer_image = DoctorOfferImage::where('id', $id)
            ->whereHas('doctor_offer', function ($query) {
                $query->where('doctor_id', auth('doctors')->id());
            })
            ->firstOrFail();
        $doctor_offer_image->update($request->validated());
        return $this->sendSuccess('Doctor Offer Image Updated Successfully', $doctor_offer_image);
    }
    public function destroy(string $id)
    {
        $doctor_offer_image = DoctorOfferImage::where('id', $id)
            ->whereHas('doctor_offer', function ($query) {
                $query->where('doctor_id', auth('doctors')->id());
            })
            ->firstOrFail();
        $doctor_offer_image->delete();
        return $this->sendSuccess('Doctor Offer Image Deleted Successfully');
    }
}
