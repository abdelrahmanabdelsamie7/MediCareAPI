<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class DoctorOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'info_about_offer' => 'nullable|string',
            'details' => 'required|string',
            'price_before_discount' => 'required|numeric|min:0',
            'discount' => 'required|integer|min:0|max:100',
            'from_day' => 'required|date',
            'to_day' => 'required|date|after_or_equal:from_day',
            'is_active' => 'boolean',
            'doctor_id' => 'required|exists:doctors,id',
            'offer_group_id' => 'required|exists:offer_groups,id',
        ];
    }
}
