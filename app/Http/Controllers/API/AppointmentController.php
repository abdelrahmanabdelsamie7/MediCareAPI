<?php
namespace App\Http\Controllers\API;
use App\Models\Appointment;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:doctors')->only(['index', 'store', 'show', 'update', 'destroy']);
    }
    public function index()
    {
        Appointment::whereDate('day', '<', now())->delete();
        $appointments = Appointment::where('doctor_id', auth('doctors')->id())->get();
        return $this->sendSuccess(
            'Doctor Appointments Retrieved Successfully',
            $appointments
        );
    }
    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();
        $data['doctor_id'] = auth('doctors')->id();
        $startTime = \Carbon\Carbon::parse($data['start_at']);
        $endTime = \Carbon\Carbon::parse($data['end_at']);
        $existingAppointment = Appointment::where('doctor_id', $data['doctor_id'])
            ->where('clinic_id', $data['clinic_id'])
            ->where('day', $data['day'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_at', [$startTime->format('H:i'), $endTime->format('H:i')])
                    ->orWhereBetween('end_at', [$startTime->format('H:i'), $endTime->format('H:i')])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_at', '<=', $startTime->format('H:i'))
                            ->where('end_at', '>=', $endTime->format('H:i'));
                    });
            })->exists();
        if ($existingAppointment) {
            return $this->sendError('This appointment overlaps with an existing appointment.', 400);
        }
        $duration = $data['duration'];
        $appointments = [];
        while ($startTime < $endTime) {
            $appointments[] = [
                'day' => $data['day'],
                'start_at' => $startTime->format('H:i'),
                'end_at' => $startTime->addMinutes($duration)->format('H:i'),
                'doctor_id' => $data['doctor_id'],
                'clinic_id' => $data['clinic_id'],
                'duration' => $duration,
            ];
        }
        Appointment::insert($appointments);

        return $this->sendSuccess('Doctor appointment Added Successfully', $appointments[0], 201);
    }
    public function show(string $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->with(['clinic'])
            ->firstOrFail();

        return $this->sendSuccess('Doctor Appointment Retrieved Successfully', $appointment);
    }
    public function update(AppointmentRequest $request, string $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->firstOrFail();
        $appointment->update($request->validated());
        return $this->sendSuccess('Doctor Appointment Updated Successfully', $appointment);
    }
    public function destroy(string $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->firstOrFail();
        $appointment->delete();
        return $this->sendSuccess('Doctor Appointment Deleted Successfully');
    }
}
