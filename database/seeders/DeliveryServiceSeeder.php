<?php
namespace Database\Seeders;
use App\Models\DeliveryService;
use Illuminate\Database\Seeder;
class DeliveryServiceSeeder extends Seeder {
  public function run() {
    DeliveryService::create([
      'name' => 'تموين',
      'description' => 'توصيل الأدوية إلى المنزل',
      'app_link' => 'https://tamween.com'
    ]);
  }
}
