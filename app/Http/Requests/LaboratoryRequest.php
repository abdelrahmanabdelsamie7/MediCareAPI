<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class LaboratoryRequest extends FormRequest
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
            'insurence' => 'required|boolean',
            'start_at' => 'date_format:H:i',
            'end_at' => 'date_format:H:i',
            'chain_laboratory_id' => 'nullable|exists:chain_laboratories,id'
        ];
    }
}