<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class TipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'question' => 'required|string',
            'answer' => 'required|string',
            'department_id' => 'required|exists:departments,id'
        ];
    }
}
