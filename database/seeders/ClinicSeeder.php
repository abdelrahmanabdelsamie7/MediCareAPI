<?php
namespace Database\Seeders;
use App\Models\Clinic;
use Illuminate\Database\Seeder;
class ClinicSeeder extends Seeder {
  public function run() {
  Clinic::create([
    'title' => 'عيادة الأسنان سوهاج',
    'description' => 'عيادة متخصصة في جميع علاجات الأسنان.',
    'phone' => '01112345678',
    'address' => 'سوهاج',
    'locationUrl' => 'https://maps.app.goo.gl/example1'
]);

Clinic::create([
    'title' => 'المجمع الطبي في سوهاج',
    'description' => 'مجمع طبي يحتوي على عدة تخصصات.',
    'phone' => '01098765432',
    'address' => 'مدينة سوهاج الجديدة',
    'locationUrl' => 'https://maps.app.goo.gl/example2'
]);

  }
}