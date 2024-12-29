<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {

        return [
            'fName' => 'required|string|max:255',
            'lName' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birthDate' => 'required|date|before:today',
            'phone' => 'required|string|min:8|max:15|regex:/^[0-9]+$/',
            'image' => 'nullable|string|max:2048',
            'whatsappLink' => 'required|url',
            'facebookLink' => 'required|url',
            'title' => 'required|string|max:255',
            'infoAboutDoctor' => 'required|string',
            'app_price' => 'required|numeric|min:0',
            'homeOption' => 'required|boolean',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:8',
            'department_id' => 'required|exists:departments,id',
        ];

    }
}
