<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'image' => 'required|string|max:2048',
            'clinic_id' => 'required|exists:clinics,id'
        ];
    }
}
