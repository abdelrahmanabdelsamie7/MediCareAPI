<?php
namespace Database\Seeders;
use App\Models\Doctor;
use App\Models\Blog;
use Illuminate\Database\Seeder;
class BlogSeeder extends Seeder {
  public function run() {
    $doctor = Doctor::first();

    Blog::create([
      'title' => 'نصائح لصحة الجهاز الهضمي',
      'content' => 'تناول الألياف وشرب الماء بانتظام.',
      'doctor_id' => $doctor->id
    ]);
  }
}
