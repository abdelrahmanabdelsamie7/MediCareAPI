<?php
namespace App\Http\Controllers\API;
use App\Models\Doctor;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DoctorUpdateRequest;

class DoctorController extends Controller
{
    use ResponseJsonTrait;

    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
        // $this->middleware('auth:doctors')->only(['show', 'update']);
    }
    public function index()
    {
        $doctors = Doctor::all();
        return $this->sendSuccess('Doctors Retrieved Successfully', $doctors);
    }
    public function store(DoctorRequest $request)
    {
        $doctor = Doctor::create($request->validated());
        return $this->sendSuccess('Doctor Added Successfully', $doctor, 201);
    }
    public function show(string $id)
    {
        $doctor = Doctor::with('department', 'specializations', 'clinics' , 'clinics.images')
            ->findOrFail($id);
        $appointmentsGroupedByDate = $doctor->appointments->groupBy('day');

        $doctorData = $doctor->toArray();
        $doctorData['appointmentsGroupedByDate'] = $appointmentsGroupedByDate;

        return response()->json([
            'success' => true,
            'message' => 'Doctor Retrieved Successfully',
            'data' => $doctorData
        ]);
    }
    public function update(DoctorUpdateRequest $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        // if (Auth::guard('doctors')->id() != $doctor->id) {
        //     return $this->sendError('Unauthorized', [], 403);
        // }

        $doctor->update($request->validated());
        return $this->sendSuccess('Doctor Updated Successfully', $doctor, 201);
    }
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return $this->sendSuccess('Doctor Deleted Successfully');
    }
    public function doctorReservations(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        if (Auth::guard('doctors')->id() != $doctor->id) {
            return $this->sendError('Unauthorized', [], 403);
        }
        $doctorReserveNotifications = $doctor->notifications->map(function ($notification) {
            return [
                'id' => $notification->id,
                'type' => $notification->type,
                'data' => $notification->data,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at,
            ];
        });
        if ($doctorReserveNotifications->isEmpty()) {
            return $this->sendSuccess('No Notifications Found', []);
        }
        return $this->sendSuccess('Doctor Notifications Retrieved Successfully', $doctorReserveNotifications->toArray());
    }
}