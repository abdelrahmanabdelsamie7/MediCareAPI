<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
class AdminSeeder extends Seeder {
  public function run() {
    Admin::create([
      'name' => 'admin',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('12345678'),
      'phone' => '01129508321'
    ]);
  }
}