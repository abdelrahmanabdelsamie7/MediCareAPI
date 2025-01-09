<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserPharmacyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'review' => "required|string",
            'rating_value' => 'required|integer|between:1,5',
            'user_id' => 'required|integer|exists:users,id',
            'pharmacy_id' => 'required|integer|exists:pharmacies,id'
        ];
    }
}
