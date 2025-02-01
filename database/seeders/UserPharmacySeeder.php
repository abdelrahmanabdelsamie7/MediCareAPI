<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\UserPharmacy;
use Illuminate\Database\Seeder;
class UserPharmacySeeder extends Seeder {
  public function run() {
    $user = User::first();
    $pharmacy = Pharmacy::first();

    UserPharmacy::create([
      'review' => 'خدمة ممتازة',
      'rating_value' => 5,
      'user_id' => $user->id,
      'pharmacy_id' => $pharmacy->id
    ]);
  }
}
