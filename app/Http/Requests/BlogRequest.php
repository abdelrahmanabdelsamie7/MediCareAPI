<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:500',
            'content' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id'
        ];
    }
}
