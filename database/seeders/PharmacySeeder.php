<?php
namespace Database\Seeders;
use App\Models\Pharmacy;
use App\Models\ChainPharmacies;
use Illuminate\Database\Seeder;
class PharmacySeeder extends Seeder {
  public function run() {
   
        // $chain = ChainPharmacies::first(); // تأكد من وجود سلسلة صيدليات

        Pharmacy::create([
            'title' => 'صيدلية دكتور رائف',
            'image' => null,
            'phone' => '01227115714',
            'service' => 'قياس ضغط – سكر – وزن',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/201227115714',
            'city' => 'سوهاج',
            'area' => 'شارع النصر من شارع 15',
            'start_at' => '09:30',
            'end_at' => '01:00',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدلية مصعب بن عمير',
            'image' => null,
            'phone' => '01117170033',
            'service' => 'التوصيل المنزلي طوال اليوم',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/201117170033',
            'city' => 'سوهاج',
            'area' => 'أول كوبري أخميم',
            'start_at' => '00:00',
            'end_at' => '23:59',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدلية د. ابانوب صفوت',
            'image' => null,
            'phone' => '0932118257',
            'service' => 'قياس الضغط والسكر والوزن',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/20932118257',
            'city' => 'سوهاج',
            'area' => 'شارع سيتي بجوار سيراميك العمدة',
            'start_at' => '09:00',
            'end_at' => '21:00',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدلية مينا حسني',
            'image' => null,
            'phone' => '01224186025',
            'service' => 'قياس ضغط – سكر – وزن',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/201224186025',
            'city' => 'جرجا',
            'area' => 'قرية بندار الغربية',
            'start_at' => '10:00',
            'end_at' => '23:00',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدلية عاطف الجديدة',
            'image' => null,
            'phone' => '0932112448',
            'service' => 'خدمة التوصيل مجانا (صباحا ومساءا)',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/20932112448',
            'city' => 'سوهاج',
            'area' => 'بجوار مركز التدريب المهني بسوهاج',
            'start_at' => '09:00',
            'end_at' => '01:00',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدلية العدل',
            'image' => null,
            'phone' => '01221409611',
            'service' => 'قياس ضغط – سكر',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/201221409611',
            'city' => 'سوهاج',
            'area' => 'شارع أسيوط سوهاج',
            'start_at' => '09:00',
            'end_at' => '01:00',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدلية عاطف',
            'image' => null,
            'phone' => '01004354618',
            'service' => 'قياس ضغط – سكر – وزن',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/201004354618',
            'city' => 'البلينا',
            'area' => 'شارع حسني مبارك',
            'start_at' => '09:00',
            'end_at' => '00:00',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدليات عابدين',
            'image' => null,
            'phone' => '19036',
            'service' => 'خدمة التوصيل متاحة طوال اليوم',
            'locationUrl' => null,
            'whatsappLink' => 'https://wa.me/2019036',
            'city' => 'سوهاج',
            'area' => '33 شارع الجمهورية',
            'start_at' => '00:00',
            'end_at' => '23:59',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

        Pharmacy::create([
            'title' => 'صيدلية الاتحاد سوهاج',
            'image' => null,
            'phone' => null,
            'service' => 'دليفري مجانا والتوصيل داخل المحافظة، توفير جميع أنواع الأدوية المحلية والمستوردة',
            'locationUrl' => null,
            'whatsappLink' => null,
            'city' => 'سوهاج',
            'area' => 'كورنيش النيل',
            'start_at' => '09:00',
            'end_at' => '21:00',
            'chain_pharmacy_id' => $chain->id ?? null
        ]);

      
  }
}