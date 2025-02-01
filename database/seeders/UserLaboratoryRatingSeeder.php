<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Laboratory;
use App\Models\UserLaboratory;
use Illuminate\Database\Seeder;
class UserLaboratoryRatingSeeder extends Seeder {
  public function run() {
    $user = User::first();
    $lab = Laboratory::first();

    UserLaboratory::create([
      'review' => 'نتائج دقيقة',
      'rating_value' => 4,
      'user_id' => $user->id,
      'laboratory_id' => $lab->id
    ]);
  }
}
