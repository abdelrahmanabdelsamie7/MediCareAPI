<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Clinic;

class DoctorClinicSeeder extends Seeder {
  public function run() {
    $doctor = Doctor::first();
    $clinic = Clinic::first();

    $doctor->clinics()->attach($clinic->id);
  }
}
