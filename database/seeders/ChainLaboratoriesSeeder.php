<?php
namespace Database\Seeders;
use App\Models\ChainLaboratories;
use Illuminate\Database\Seeder;
class ChainLaboratoriesSeeder extends Seeder
{
    public function run()
    {
        ChainLaboratories::create([
            'title' => 'معامل الصحة'
        ]);
        ChainLaboratories::create([
            'title' => 'معامل العرب'
        ]);

        ChainLaboratories::create([
            'title' => 'معامل الأمل'
        ]);

    }

}