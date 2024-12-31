<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class DoctorOfferImageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'image' => 'required|string|max:2048',
            'doctor_offer_id' => 'required|exists:doctor_offers,id'
        ];
    }
}
