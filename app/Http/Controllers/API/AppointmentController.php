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
        $appointments = Appointment::where('doctor_id', auth('doctors')->id())->get();
        return $this->sendSuccess(
            'Doctor appointments Retrieved Successfully',
            $appointments
        );
    }
    public function store(AppointmentRequest $request)
    {
        $appointment = Appointment::create(array_merge(
            $request->validated(),
            ['doctor_id' => auth('doctors')->id()]
        ));

        return $this->sendSuccess('Doctor Appointment Added Successfully', $appointment, 201);
    }

    public function show(string $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->with(['doctor'])
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
