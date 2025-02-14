<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class OfferGroupRequest extends FormRequest
{
     public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'image' => 'required|string|max:2048',
            'title' => 'string|required|min:3|max:255',
        ];
    }
}
