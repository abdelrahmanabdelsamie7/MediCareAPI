<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use App\Models\ChainLaboratories; // Ensure this model exists
use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder
{
    public function run()
    {
        // Create a chain laboratory first
        $chain = ChainLaboratories::create([
            'title' => 'معامل الصحة'
        ]);

        // Create laboratories

        Laboratory::create([
            'title' => 'معمل آل حيان',
            'service' => 'جميع أنواع التحاليل الطبية وأبحاث الدم',
            'image' => 'default-laboratory.png',
            'phone' => '01095353495',
            'city' => 'سوهاج',
            'area' => 'ميدان العارف',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '08:00',
            'end_at' => '22:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معمل الخليه',
            'service' => 'تحاليل الخلايا والأنسجة والأورام',
            'image' => 'default-laboratory.png',
            'phone' => '01122609987',
            'city' => 'سوهاج',
            'area' => 'الشهيد',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '09:00',
            'end_at' => '23:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معمل الفحوص والتحاليل الطبية',
            'service' => 'جميع أنواع التحاليل الطبية',
            'image' => 'default-laboratory.png',
            'phone' => '01221530933',
            'city' => 'سوهاج',
            'area' => 'شارع المحطة',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '10:00',
            'end_at' => '22:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معمل مستشفى الحياة الدولي',
            'service' => 'جميع أنواع التحاليل الطبية',
            'image' => 'default-laboratory.png',
            'phone' => '0932157003',
            'city' => 'سوهاج',
            'area' => 'بجوار نادي الشرطة القبلي',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '00:00',
            'end_at' => '23:59',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معمل الشهيد',
            'service' => 'جميع أنواع التحاليل الطبية وأبحاث الدم',
            'image' => 'default-laboratory.png',
            'phone' => '01001640100',
            'city' => 'سوهاج',
            'area' => 'ميدان الشهيد',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '10:00',
            'end_at' => '22:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معمل المدينة للتحاليل الطبية',
            'service' => 'جميع أنواع التحاليل الطبية',
            'image' => 'default-laboratory.png',
            'phone' => '01151705541',
            'city' => 'سوهاج',
            'area' => 'شرقي كبري أولاد علي',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '09:00',
            'end_at' => '21:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معمل رؤية للتحاليل الطبية',
            'service' => 'جميع أنواع التحاليل الطبية وأبحاث الدم',
            'image' => 'default-laboratory.png',
            'phone' => '01020878522',
            'city' => 'سوهاج',
            'area' => 'البلينا، شارع ديوان الري',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '09:00',
            'end_at' => '21:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معمل الرجاء التخصصي',
            'service' => 'تحاليل طبية وأبحاث الدم',
            'image' => 'default-laboratory.png',
            'phone' => '01001940332',
            'city' => 'سوهاج',
            'area' => 'شارع أحمد ابن حنبل',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '10:00',
            'end_at' => '22:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

        Laboratory::create([
            'title' => 'معامل نيو لاب',
            'service' => 'جميع أنواع التحاليل الطبية وأبحاث الدم',
            'image' => 'default-laboratory.png',
            'phone' => '01060004609',
            'city' => 'سوهاج',
            'area' => 'ميدان الشهيد، برج الأطباء',
            'locationUrl' => null,
            'whatsappLink' => null,
            'insurence' => false,
            'start_at' => '10:00',
            'end_at' => '22:00',
            'avg_rate' => 0.00,
            'chain_laboratory_id' => null
        ]);

    }
}