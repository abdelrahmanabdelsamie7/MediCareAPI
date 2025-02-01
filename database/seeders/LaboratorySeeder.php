<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use App\Models\ChainLaboratories; // Ensure this model exists
use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder {
  public function run() {
    // Create a chain laboratory first
    $chain = ChainLaboratories::create([
      'title' => 'معامل الصحة'
    ]);

    // Create laboratories
    Laboratory::create([
      'title' => 'معمل القاهرة المركزي',
      'service' => 'تحاليل الدم والأشعة',
      'image'=>'https://th.bing.com/th/id/OIP.EoFMLLmGFkalkVbd81mIUAHaEK?w=288&h=180&c=7&r=0&o=5&dpr=1.1&pid=1.7',
      'phone' => '01001112222',
      'city' => 'سوهاج',
       'area' => 'طما',
      'chain_laboratory_id' => $chain->id,
      'locationUrl' => 'https://maps.app.goo.gl/example',
      'whatsappLink' => 'https://wa.me/201111111111',
    ]);
    Laboratory::create([
        'title' => 'معمل القاهرة المركزي',
        'service' => 'تحاليل الدم والأشعة',
        'image'=>'https://th.bing.com/th/id/OIP.EoFMLLmGFkalkVbd81mIUAHaEK?w=288&h=180&c=7&r=0&o=5&dpr=1.1&pid=1.7',
        'phone' => '01001112222',
        'city' => 'سوهاج',
         'area' => 'طما',
        'chain_laboratory_id' => $chain->id,
        'locationUrl' => 'https://maps.app.goo.gl/example',
        'whatsappLink' => 'https://wa.me/201111111111',
      ]);  Laboratory::create([
        'title' => 'معمل القاهرة المركزي',
        'service' => 'تحاليل الدم والأشعة',
        'image'=>'https://th.bing.com/th/id/OIP.EoFMLLmGFkalkVbd81mIUAHaEK?w=288&h=180&c=7&r=0&o=5&dpr=1.1&pid=1.7',
        'phone' => '01001112222',
        'city' => 'سوهاج',
         'area' => 'طما',
        'chain_laboratory_id' => $chain->id,
        'locationUrl' => 'https://maps.app.goo.gl/example',
        'whatsappLink' => 'https://wa.me/201111111111',
      ]);
      Laboratory::create([
        'title' => 'معمل القاهرة المركزي',
        'service' => 'تحاليل الدم والأشعة',
        'image'=>'https://th.bing.com/th/id/OIP.EoFMLLmGFkalkVbd81mIUAHaEK?w=288&h=180&c=7&r=0&o=5&dpr=1.1&pid=1.7',
        'phone' => '01001112222',
        'city' => 'سوهاج',
         'area' => 'طما',
        'chain_laboratory_id' => $chain->id,
        'locationUrl' => 'https://maps.app.goo.gl/example',
        'whatsappLink' => 'https://wa.me/201111111111',
      ]);
      Laboratory::create([
          'title' => 'معمل القاهرة المركزي',
          'service' => 'تحاليل الدم والأشعة',
          'image'=>'https://th.bing.com/th/id/OIP.EoFMLLmGFkalkVbd81mIUAHaEK?w=288&h=180&c=7&r=0&o=5&dpr=1.1&pid=1.7',
          'phone' => '01001112222',
          'city' => 'سوهاج',
           'area' => 'طما',
          'chain_laboratory_id' => $chain->id,
          'locationUrl' => 'https://maps.app.goo.gl/example',
          'whatsappLink' => 'https://wa.me/201111111111',
        ]);  Laboratory::create([
          'title' => 'معمل القاهرة المركزي',
          'service' => 'تحاليل الدم والأشعة',
          'image'=>'https://th.bing.com/th/id/OIP.EoFMLLmGFkalkVbd81mIUAHaEK?w=288&h=180&c=7&r=0&o=5&dpr=1.1&pid=1.7',
          'phone' => '01001112222',
          'city' => 'سوهاج',
           'area' => 'طما',
          'chain_laboratory_id' => $chain->id,
          'locationUrl' => 'https://maps.app.goo.gl/example',
          'whatsappLink' => 'https://wa.me/201111111111',
        ]);

    // Add more laboratories if needed
  }
}
