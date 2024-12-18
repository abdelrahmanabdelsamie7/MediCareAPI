<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ChainLaboratoriesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'string|required|min:3|max:255',
        ];
    }
}
