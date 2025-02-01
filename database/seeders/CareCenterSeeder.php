<?php
namespace Database\Seeders;
use App\Models\CareCenter;
use Illuminate\Database\Seeder;
class CareCenterSeeder extends Seeder {
  public function run() {
    CareCenter::create([
      'title' => 'مركز الرعاية الأولية',
      'service' => 'خدمات رعاية صحية شاملة',
      'phone' => '0123456789',
      'address' => 'القاهرة',
      'locationUrl' => 'https://maps.app.goo.gl/example',
    ]);
  }
}
