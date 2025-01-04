<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\ClinicImageRequest;
use App\Models\ClinicImage;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class ClinicImageController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $clinic_images = ClinicImage::all();
        return $this->sendSuccess('Clinic Images Retrieved Successfully', $clinic_images);
    }
    public function store(ClinicImageRequest $request)
    {
        $clinic_image = ClinicImage::create($request->validated());
        return $this->sendSuccess('Clinic Image Added Successfully', $clinic_image, 201);
    }
    public function show(string $id)
    {
        $clinic_image = ClinicImage::findOrFail($id);
        return $this->sendSuccess('Clinic Image Retireved Successfully', $clinic_image);
    }
    public function update(ClinicImageRequest $request, string $id)
    {
        $clinic_image = ClinicImage::findOrFail($id);
        $clinic_image->update($request->validated());
        return $this->sendSuccess('Clinic Image Updated Successfully', $clinic_image, 201);
    }
    public function destroy(string $id)
    {
        $clinic_image = ClinicImage::findOrFail($id);
        $clinic_image->delete();
        return $this->sendSuccess('Clinic Image Deleted Successfully');
    }
}
