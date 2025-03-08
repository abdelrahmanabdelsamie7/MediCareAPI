<?php
namespace Database\Seeders;
use App\Models\DeliveryService;
use Illuminate\Database\Seeder;
class DeliveryServiceSeeder extends Seeder {
  public function run() {
      DeliveryService::create([
        'name' => 'تموين',
        'description' => 'توصيل الأدوية إلى المنزل للمرضى',
        'app_link' => 'https://tamween.com'
    ]);

    DeliveryService::create([
        'name' => 'أدوية توصيل',
        'description' => 'خدمة توصيل الأدوية للمرضى في كافة أنحاء المدينة',
        'app_link' => 'https://adwiyat-tawseel.com'
    ]);

    DeliveryService::create([
        'name' => 'رعاية طبية',
        'description' => 'توصيل المعدات الطبية مثل أجهزة قياس السكر وضغط الدم',
        'app_link' => 'https://raya-medical.com'
    ]);

    DeliveryService::create([
        'name' => 'حجز وتنقل',
        'description' => 'خدمة توصيل المرضى إلى المستشفيات والعيادات',
        'app_link' => 'https://hajz-tanqel.com'
    ]);

    DeliveryService::create([
        'name' => 'مساعد طبية',
        'description' => 'توصيل الأدوية والمستلزمات الطبية الضرورية للمرضى',
        'app_link' => 'https://mosaed-tabea.com'
    ]);

  }
}