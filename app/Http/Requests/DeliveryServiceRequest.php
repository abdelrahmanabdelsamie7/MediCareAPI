<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class DeliveryServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'app_link' => 'required|string',
        ];
    }
}
