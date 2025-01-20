<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'clinic_id' => 'required|exists:clinics,id',
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,canceled',
        ];
    }
}
