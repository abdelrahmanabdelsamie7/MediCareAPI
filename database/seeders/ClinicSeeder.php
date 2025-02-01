<?php
namespace Database\Seeders;
use App\Models\Clinic;
use Illuminate\Database\Seeder;
class ClinicSeeder extends Seeder {
  public function run() {
    Clinic::create([
      'title' => 'عيادة الدكتور عبدالرحمن',
      'description' => 'وصف العيادة',
      'phone' => '01129508321',
      'address' => 'سوهاج',
      'locationUrl' => 'https://maps.app.goo.gl/LV7yNWwzFuyR6W6x9'
    ]);
  }
}
