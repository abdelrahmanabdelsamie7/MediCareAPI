<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PharmacyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'service' => 'required|string',
            'image' => 'nullable|max:2048',
            'phone' => 'required|string|min:8|max:15',
            'area' => 'required|string',
            'city' => 'required|string',
            'locationUrl' => 'required|string|url',
            'whatsappLink' => 'required|string|url',
            'deliveryOption' => 'required|boolean',
            'insurence' => 'required|boolean',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'chain_pharmacy_id' => 'nullable|exists:chain_pharmacies,id'
        ];
    }
}
