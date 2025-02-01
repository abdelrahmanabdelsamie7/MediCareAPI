<?php
namespace Database\Seeders;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Clinic;
use Illuminate\Database\Seeder;
class AppointmentSeeder extends Seeder {
  public function run() {
    $doctor = Doctor::first();
    $clinic = Clinic::first();

    Appointment::create([
      'day' => '2025-01-25',
      'start_at' => '18:00',
      'end_at' => '20:00',
      'duration' => 30,
      'doctor_id' => $doctor->id,
      'clinic_id' => $clinic->id
    ]);
  }
}
