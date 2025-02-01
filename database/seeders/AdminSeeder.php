<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
class AdminSeeder extends Seeder {
  public function run() {
    Admin::create([
      'name' => 'mohamedali',
      'email' => 'moali@gmail.com',
      'password' => bcrypt('moali123'),
      'phone' => '01129508321'
    ]);
  }
}
