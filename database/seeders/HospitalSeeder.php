<?php
namespace Database\Seeders;
use App\Models\Hospital;
use Illuminate\Database\Seeder;
class HospitalSeeder extends Seeder {
  public function run() {
    Hospital::create([
      'title' => 'مستشفي الحياة',
      'service' => 'تقدم خدمات طبية في جميع التخصصات',
      'phone' => '01008217377',
      'address' => 'سوهاج',
      'locationUrl' => 'https://maps.app.goo.gl/6BuewXQdPcriq5mL8'
    ]);
  }
}
