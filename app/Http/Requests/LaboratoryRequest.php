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
            'address' => 'required|string',
            'locationUrl' => 'required|string|url',
            'whatsappLink' => 'required|string|url',
            'insurence' => 'required|boolean',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'chain_laboratory_id' => 'required|exists:chain_laboratories,id'
        ];
    }
}
