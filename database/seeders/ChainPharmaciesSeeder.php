<?php
namespace Database\Seeders;
use App\Models\ChainPharmacies;
use Illuminate\Database\Seeder;
class ChainPharmaciesSeeder extends Seeder {
  public function run() {
    ChainPharmacies::create([
      'title' => 'صيدليات عابدين'
    ]);
  }
}
