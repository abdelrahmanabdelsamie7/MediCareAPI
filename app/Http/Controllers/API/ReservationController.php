<?php
namespace App\Http\Controllers\API;
use App\Models\Doctor;
use App\Models\User;
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
            'doctor_name' => $doctor->fName,
            'user_name' => $user->name,  // استخدام المستخدم المسترجع
            'appointment_time' => $appointment->id,
            'status' => $reservation->status,
        ];
        // إرسال الإشعار للطبيب
        $doctor = Doctor::find($reservation->doctor_id); // الطبيب
        $doctor->notify(new ReservationNotification($reservationData));

        // إرسال الإشعار للمستخدم
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
}
