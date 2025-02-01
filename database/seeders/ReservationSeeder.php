<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
class ReservationSeeder extends Seeder {
  public function run() {
    $user = User::first();
    $doctor = Doctor::first();
    $appointment = Appointment::first();
    $clinic = Clinic::first();

    Reservation::create([
      'doctor_id' => $doctor->id,
      'user_id' => $user->id,
      'appointment_id' => $appointment->id,
      'clinic_id' => $clinic->id,
      'status' => 'pending'
    ]);
  }
}
