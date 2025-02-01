<?php
namespace Database\Seeders;
use App\Models\Pharmacy;
use App\Models\ChainPharmacies;
use Illuminate\Database\Seeder;
class PharmacySeeder extends Seeder {
  public function run() {
    $chain = ChainPharmacies::first(); // Ensure chain exists

    Pharmacy::create([
      'title' => 'صيدلية محمد',
      'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
      'phone' => '01111111111',
      'service' => 'توفير الأدوية بأسعار مخفضة',
      'locationUrl' => 'https://maps.app.goo.gl/example',
      'whatsappLink' => 'https://wa.me/201111111111',
      'city' => 'سوهاج',
      'area' => 'طما',
    ]);
    Pharmacy::create([
        'title' => 'صيدلية العابدين',
        'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
        'phone' => '01111111111',
        'service' => 'توفير الأدوية بأسعار مخفضة',
        'locationUrl' => 'https://maps.app.goo.gl/example',
        'whatsappLink' => 'https://wa.me/201111111111',
        'city' => 'القاهره',
        'area' => 'طما',
        'chain_pharmacy_id' => $chain->id
      ]);
      Pharmacy::create([
        'title' => 'صيدلية العابدين',
        'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
        'phone' => '01111111111',
        'service' => 'توفير الأدوية بأسعار مخفضة',
        'locationUrl' => 'https://maps.app.goo.gl/example',
        'whatsappLink' => 'https://wa.me/201111111111',
        'city' => 'سوهاج',
        'area' => 'العسيرات',
        'chain_pharmacy_id' => $chain->id
      ]);
      Pharmacy::create([
        'title' => 'صيدلية محمد',
        'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
        'phone' => '01111111111',
        'service' => 'توفير الأدوية بأسعار مخفضة',
        'locationUrl' => 'https://maps.app.goo.gl/example',
        'whatsappLink' => 'https://wa.me/201111111111',
        'city' => 'سوهاج',
        'area' => 'طما',
      ]);
      Pharmacy::create([
          'title' => 'صيدلية العابدين',
          'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
          'phone' => '01111111111',
          'service' => 'توفير الأدوية بأسعار مخفضة',
          'locationUrl' => 'https://maps.app.goo.gl/example',
          'whatsappLink' => 'https://wa.me/201111111111',
          'city' => 'القاهره',
          'area' => 'طما',
          'chain_pharmacy_id' => $chain->id
        ]);
        Pharmacy::create([
          'title' => 'صيدلية العابدين',
          'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
          'phone' => '01111111111',
          'service' => 'توفير الأدوية بأسعار مخفضة',
          'locationUrl' => 'https://maps.app.goo.gl/example',
          'whatsappLink' => 'https://wa.me/201111111111',
          'city' => 'سوهاج',
          'area' => 'العسيرات',
          'chain_pharmacy_id' => $chain->id
        ]);
        Pharmacy::create([
            'title' => 'صيدلية محمد',
            'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
            'phone' => '01111111111',
            'service' => 'توفير الأدوية بأسعار مخفضة',
            'locationUrl' => 'https://maps.app.goo.gl/example',
            'whatsappLink' => 'https://wa.me/201111111111',
            'city' => 'سوهاج',
            'area' => 'طما',
          ]);
          Pharmacy::create([
              'title' => 'صيدلية العابدين',
              'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
              'phone' => '01111111111',
              'service' => 'توفير الأدوية بأسعار مخفضة',
              'locationUrl' => 'https://maps.app.goo.gl/example',
              'whatsappLink' => 'https://wa.me/201111111111',
              'city' => 'القاهره',
              'area' => 'طما',
              'chain_pharmacy_id' => $chain->id
            ]);
            Pharmacy::create([
              'title' => 'صيدلية العابدين',
              'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
              'phone' => '01111111111',
              'service' => 'توفير الأدوية بأسعار مخفضة',
              'locationUrl' => 'https://maps.app.goo.gl/example',
              'whatsappLink' => 'https://wa.me/201111111111',
              'city' => 'سوهاج',
              'area' => 'العسيرات',
              'chain_pharmacy_id' => $chain->id
            ]);
            Pharmacy::create([
                'title' => 'صيدلية محمد',
                'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                'phone' => '01111111111',
                'service' => 'توفير الأدوية بأسعار مخفضة',
                'locationUrl' => 'https://maps.app.goo.gl/example',
                'whatsappLink' => 'https://wa.me/201111111111',
                'city' => 'سوهاج',
                'area' => 'طما',
              ]);
              Pharmacy::create([
                  'title' => 'صيدلية العابدين',
                  'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                  'phone' => '01111111111',
                  'service' => 'توفير الأدوية بأسعار مخفضة',
                  'locationUrl' => 'https://maps.app.goo.gl/example',
                  'whatsappLink' => 'https://wa.me/201111111111',
                  'city' => 'القاهره',
                  'area' => 'طما',
                  'chain_pharmacy_id' => $chain->id
                ]);
                Pharmacy::create([
                  'title' => 'صيدلية العابدين',
                  'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                  'phone' => '01111111111',
                  'service' => 'توفير الأدوية بأسعار مخفضة',
                  'locationUrl' => 'https://maps.app.goo.gl/example',
                  'whatsappLink' => 'https://wa.me/201111111111',
                  'city' => 'سوهاج',
                  'area' => 'العسيرات',
                  'chain_pharmacy_id' => $chain->id
                ]);
                Pharmacy::create([
                  'title' => 'صيدلية محمد',
                  'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                  'phone' => '01111111111',
                  'service' => 'توفير الأدوية بأسعار مخفضة',
                  'locationUrl' => 'https://maps.app.goo.gl/example',
                  'whatsappLink' => 'https://wa.me/201111111111',
                  'city' => 'سوهاج',
                  'area' => 'طما',
                ]);
                Pharmacy::create([
                    'title' => 'صيدلية العابدين',
                    'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                    'phone' => '01111111111',
                    'service' => 'توفير الأدوية بأسعار مخفضة',
                    'locationUrl' => 'https://maps.app.goo.gl/example',
                    'whatsappLink' => 'https://wa.me/201111111111',
                    'city' => 'القاهره',
                    'area' => 'طما',
                    'chain_pharmacy_id' => $chain->id
                  ]);
                  Pharmacy::create([
                    'title' => 'صيدلية العابدين',
                    'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                    'phone' => '01111111111',
                    'service' => 'توفير الأدوية بأسعار مخفضة',
                    'locationUrl' => 'https://maps.app.goo.gl/example',
                    'whatsappLink' => 'https://wa.me/201111111111',
                    'city' => 'سوهاج',
                    'area' => 'العسيرات',
                    'chain_pharmacy_id' => $chain->id
                  ]);
                  Pharmacy::create([
                      'title' => 'صيدلية محمد',
                      'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                      'phone' => '01111111111',
                      'service' => 'توفير الأدوية بأسعار مخفضة',
                      'locationUrl' => 'https://maps.app.goo.gl/example',
                      'whatsappLink' => 'https://wa.me/201111111111',
                      'city' => 'سوهاج',
                      'area' => 'طما',
                    ]);
                    Pharmacy::create([
                        'title' => 'صيدلية العابدين',
                        'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                        'phone' => '01111111111',
                        'service' => 'توفير الأدوية بأسعار مخفضة',
                        'locationUrl' => 'https://maps.app.goo.gl/example',
                        'whatsappLink' => 'https://wa.me/201111111111',
                        'city' => 'القاهره',
                        'area' => 'طما',
                        'chain_pharmacy_id' => $chain->id
                      ]);
                      Pharmacy::create([
                        'title' => 'صيدلية العابدين',
                        'image'=>'https://th.bing.com/th/id/OIP.aUD1h0sIXJ10_yzv5m317QHaE8?w=272&h=181&c=7&r=0&o=5&dpr=1.1&pid=1.7',
                        'phone' => '01111111111',
                        'service' => 'توفير الأدوية بأسعار مخفضة',
                        'locationUrl' => 'https://maps.app.goo.gl/example',
                        'whatsappLink' => 'https://wa.me/201111111111',
                        'city' => 'سوهاج',
                        'area' => 'العسيرات',
                        'chain_pharmacy_id' => $chain->id
                      ]);

  }
}
