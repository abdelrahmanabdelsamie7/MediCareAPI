<?php
namespace Database\Seeders;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
class DoctorSpecializationSeeder extends Seeder {
  public function run() {
    $doctor = Doctor::first();
    $specialization = Specialization::create(['title' => 'جراحة تجميل الوجه']);

    $doctor->specializations()->attach($specialization->id);
  }
}
