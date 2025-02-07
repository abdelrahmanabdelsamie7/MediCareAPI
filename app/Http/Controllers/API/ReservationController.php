<?php
namespace App\Http\Controllers\API;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ReservationNotification;


class ReservationController extends Controller
{
    public function getAvailableAppointments($doctorId, $day)
    {
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->where('day', $day)
            ->where('is_booked', false)
            ->get();
        return response()->json([
            'message' => 'Available Appointments',
            'data' => $appointments
        ]);
    }
    public function store(Request $request)
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'clinic_id' => 'required|exists:clinics,id',
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);
        $existingReservation = Reservation::where('appointment_id', $validated['appointment_id'])->exists();
        if ($existingReservation) {
            return response()->json(['message' => 'This appointment is already reserved.'], 400);
        }
        $appointment = Appointment::find($validated['appointment_id']);
        if ($appointment->is_booked) {
            return response()->json(['message' => 'This appointment is already booked.'], 400);
        }
        $appointment->is_booked = true;
        $appointment->save();
        $reservation = Reservation::create([
            'user_id' => $user->id,
            'doctor_id' => $validated['doctor_id'],
            'clinic_id' => $validated['clinic_id'],
            'appointment_id' => $validated['appointment_id'],
            'status' => $validated['status'],
        ]);
        $doctor = Doctor::find($reservation->doctor_id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
        $user = User::find($reservation->user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $reservationData = [
            'message' => 'تم حجز موعد جديد',
            'doctor_name' => $doctor->fName . ' ' . $doctor->lName,
            'user_name' => $user->name,
            'user_phone' => $user->phone,
            'user_address' => $user->address,
            'appointment_day' => $appointment->day,
            'start_appointment' => $appointment->start_at,
            'end_appointment' => $appointment->end_at,
            'duration_appointment' => $appointment->duration,
        ];
        $doctor = Doctor::find($reservation->doctor_id);
        $doctor->notify(new ReservationNotification($reservationData));
        $user->notify(new ReservationNotification($reservationData));
        return response()->json([
            'message' => 'Reservation Created Successfully',
            'data' => $reservation
        ], 201);
    }
    public function confirmReservation($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        if ($reservation->user_id !== auth('api')->user()->id) {
            return response()->json(['message' => 'You are not authorized to confirm this reservation.'], 403);
        }
        if ($reservation->status != 'pending') {
            return response()->json(['message' => 'This reservation cannot be confirmed.'], 400);
        }
        $reservation->status = 'confirmed';
        $reservation->save();
        $appointment = Appointment::findOrFail($reservation->appointment_id);
        $appointment->is_booked = true;
        $appointment->save();
        return response()->json([
            'message' => 'Reservation confirmed successfully.',
            'data' => $reservation
        ]);
    }
    public function cancelReservation($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        if ($reservation->user_id !== auth('api')->user()->id) {
            return response()->json(['message' => 'You are not authorized to cancel this reservation.'], 403);
        }

        $reservation->delete();
        $appointment = Appointment::findOrFail($reservation->appointment_id);
        $appointment->is_booked = false;
        $appointment->save();
        return response()->json([
            'message' => 'Reservation canceled and deleted successfully.',
        ]);
    }
    public function getUserReservations()
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $reservations = $user->reservations()->with(['doctor', 'clinic', 'appointment'])->get();

        return response()->json([
            'message' => 'User Reservations Retrieved Successfully',
            'data' => $reservations
        ], 200);
    }
    public function getDoctorReservations()
    {
        $doctor = auth('doctors')->user();
        if (!$doctor || $doctor->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized or Not a Doctor'], 401);
        }
        $reservations = Reservation::where('doctor_id', $doctor->id)
            ->with(['user', 'clinic', 'appointment'])
            ->get();
        return response()->json([
            'message' => 'Doctor Reservations Retrieved Successfully',
            'data' => $reservations
        ], 200);
    }
    public function markNotificationAsRead($notificationId)
    {
        $user = auth('api')->user() ?? auth('doctors')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $notification = $user->notifications()->where('id', $notificationId)->first();
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marked as read']);
    }

}
