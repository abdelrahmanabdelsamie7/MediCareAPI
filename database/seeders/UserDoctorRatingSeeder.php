<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Doctor;
use App\Models\UserDoctor;
use Illuminate\Database\Seeder;
class UserDoctorRatingSeeder extends Seeder {
  public function run() {
    $user = User::first();
    $doctor = Doctor::first();

    UserDoctor::create([
      'review' => 'طبيب ممتاز',
      'rating_value' => 5,
      'user_id' => $user->id,
      'doctor_id' => $doctor->id
    ]);
  }
}
