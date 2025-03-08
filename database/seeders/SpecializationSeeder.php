<?php
namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    public function run()
    {
        Specialization::create([
            'title' => 'جراحة تجميل الوجه'
        ]);

        Specialization::create([
            'title' => 'أمراض الجهاز الهضمي'
        ]);

        Specialization::create([
            'title' => 'أمراض القلب'
        ]);

        Specialization::create([
            'title' => 'أمراض العيون'
        ]);

        Specialization::create([
            'title' => 'أمراض الأسنان'
        ]);

        Specialization::create([
            'title' => 'الأمراض الجلدية'
        ]);

        Specialization::create([
            'title' => 'الأمراض النفسية'
        ]);

        Specialization::create([
            'title' => 'جراحة العظام'
        ]);

        Specialization::create([
            'title' => 'أمراض السكري والغدد الصماء'
        ]);

        Specialization::create([
            'title' => 'طب الأطفال'
        ]);
    }
}