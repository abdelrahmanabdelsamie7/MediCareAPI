<?php
namespace Database\Seeders;
use App\Models\ChainLaboratories;
use Illuminate\Database\Seeder;
class ChainLaboratoriesSeeder extends Seeder {
  public function run() {
    ChainLaboratories::create([
      'title' => 'معامل الصحة'
    ]);
  }
}
