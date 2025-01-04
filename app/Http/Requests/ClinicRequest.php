<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'required|string|min:8|max:15',
            'address' => 'required|string',
            'locationUrl' => 'required|url',
        ];
    }
}
