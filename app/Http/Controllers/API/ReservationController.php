<?php
namespace App\Http\Controllers\API;
use App\Models\{Doctor, Appointment, Reservation};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use App\Mail\ReservationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction(); //  Begin transaction

            //  Lock the appointment row to prevent race conditions
            $appointment = Appointment::where('id', $validated['appointment_id'])->lockForUpdate()->first();

            if (!$appointment) {
                DB::rollBack();
                return response()->json(['message' => 'Appointment not found.'], 404);
            }

            $existingReservation = Reservation::where('appointment_id', $validated['appointment_id'])->exists();
            if ($existingReservation || $appointment->is_booked) {
                DB::rollBack();
                return response()->json(['message' => 'This appointment is already reserved.'], 400);
            }

            $doctor = Doctor::find($validated['doctor_id']);
            if (!$doctor) {
                DB::rollBack();
                return response()->json(['message' => 'Doctor not found'], 404);
            }

            $discount = (($user->points / 10) * 5);
            $final_price = $doctor->app_price - $discount;
            $pointsToDeduct = floor($user->points / 10) * 10;

            if ($user->points >= $pointsToDeduct && $pointsToDeduct >= 0) {
                $user->points -= $pointsToDeduct;
                $user->save();

                $reservation = Reservation::create([
                    'user_id' => $user->id,
                    'doctor_id' => $validated['doctor_id'],
                    'clinic_id' => $validated['clinic_id'],
                    'appointment_id' => $validated['appointment_id'],
                    'status' => $validated['status'],
                    'final_price' => $final_price,
                ]);

                $appointment->is_booked = true;
                $appointment->save();

                $reservation->final_price = $final_price;
                $reservation->save();

                DB::commit(); //  Commit after all operations

                Mail::to($user->email)->send(new ReservationMail($reservation, $user));

                return response()->json([
                    'message' => 'Reservation Created Successfully with Discount',
                    'data' => $reservation
                ], 201);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'You do not have enough points to complete the reservation.'], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
            return response()->json(['message' => 'An error occurred while creating the reservation.', 'error' => $e->getMessage()], 500);
        }
    }
    public function confirmReservation($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $user = auth('api')->user();
        if ($reservation->user_id !== $user->id && $reservation->doctor_id !== $user->id) {
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
        $user = auth('api')->user();
        if ($reservation->user_id !== $user->id && $reservation->doctor_id !== $user->id) {
            return response()->json(['message' => 'You are not authorized to cancel this reservation.'], 403);
        }
        DatabaseNotification::where('data->reservation_id', $reservation->id)->delete();
        $appointment = Appointment::findOrFail($reservation->appointment_id);
        $appointment->is_booked = false;
        $appointment->save();
        $reservation->delete();
        return response()->json([
            'message' => 'Reservation canceled, notification deleted, and appointment updated successfully.',
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
    public function getReservationById($id)
    {
        $doctor = auth('doctors')->user();
        if (!$doctor || $doctor->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized or Not a Doctor'], 401);
        }
        $reservation = Reservation::where('doctor_id', $doctor->id)
            ->where('id', $id)
            ->with(['user', 'clinic', 'appointment'])
            ->first();

        if (!$reservation) {
            return response()->json(['message' => 'Reservation Not Found'], 404);
        }
        return response()->json([
            'message' => 'Reservation Retrieved Successfully',
            'data' => $reservation
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
    public function doctorConfirmReservation($reservationId)
    {
        $doctor = auth('doctors')->user();
        if (!$doctor || $doctor->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized or Not a Doctor'], 401);
        }
        $reservation = Reservation::where('doctor_id', $doctor->id)->findOrFail($reservationId);

        if ($reservation->status != 'pending') {
            return response()->json(['message' => 'This reservation cannot be confirmed.'], 400);
        }
        $reservation->status = 'confirmed';
        $reservation->save();
        $appointment = Appointment::findOrFail($reservation->appointment_id);
        $appointment->is_booked = true;
        $appointment->save();
        return response()->json([
            'message' => 'Reservation confirmed successfully by the doctor.',
            'data' => $reservation
        ]);
    }
    public function doctorCancelReservation($reservationId)
    {
        $doctor = auth('doctors')->user();
        if (!$doctor || $doctor->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized or Not a Doctor'], 401);
        }
        $reservation = Reservation::where('doctor_id', $doctor->id)->findOrFail($reservationId);
        if ($reservation->status == 'canceled') {
            return response()->json(['message' => 'This reservation is already canceled.'], 400);
        }
        DatabaseNotification::where('data->reservation_id', $reservation->id)->delete();
        $appointment = Appointment::findOrFail($reservation->appointment_id);
        $appointment->is_booked = false;
        $appointment->save();
        $reservation->status = 'canceled';
        $reservation->save();
        return response()->json([
            'message' => 'Reservation canceled successfully by the doctor.',
            'data' => $reservation
        ]);
    }
    public function markAsVisited($reservationId)
    {
        $doctor = auth('doctors')->user();


        if (!$doctor || $doctor->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized or Not a Doctor'], 401);
        }
        $reservation = Reservation::where('doctor_id', $doctor->id)->findOrFail($reservationId);
        if ($reservation->status !== 'confirmed') {
            return response()->json(['message' => 'Only confirmed reservations can be marked as visited.'], 400);
        }
        $reservation->status = 'visited';
        $reservation->save();
        return response()->json([
            'message' => 'Reservation marked as visited successfully.',
            'data' => $reservation
        ]);
    }
}
