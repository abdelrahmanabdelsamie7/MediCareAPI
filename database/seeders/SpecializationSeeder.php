<?php
namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder {
  public function run() {
    Specialization::create([
      'title' => 'جراحة تجميل الوجه'
    ]);

    Specialization::create([
      'title' => 'أمراض الجهاز الهضمي'
    ]);

    // Add more specializations
  }
}
