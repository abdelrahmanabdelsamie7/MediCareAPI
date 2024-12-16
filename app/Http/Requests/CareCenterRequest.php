<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CareCenterRequest extends FormRequest
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
            'locationUrl' => 'url',
        ];
    }
}
