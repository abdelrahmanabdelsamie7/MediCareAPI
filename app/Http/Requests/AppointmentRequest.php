<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'day' => 'required|string|in:Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday',
            'start_at' => 'required|date_format:H:i',
            'end_at' => 'required|date_format:H:i|after:start_at',
            'doctor_id' => 'required|exists:doctors,id',
            'clinic_id' => 'required|exists:clinics,id',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $doctorId = auth('doctors')->id();
            $clinicId = $this->input('clinic_id');
            $doctorWorksInClinic = \DB::table('clinic_doctor')
                ->where('doctor_id', $doctorId)
                ->where('clinic_id', $clinicId)
                ->exists();

            if (!$doctorWorksInClinic) {
                $validator->errors()->add('clinic_id', 'The selected clinic is not assigned to this doctor.');
            }
        });
    }
}
