<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
class AdminSeeder extends Seeder {
  public function run() {
    Admin::create([
      'name' => 'Abdelrahman Abdelsamie',
      'email' => 'admin@medicare.com',
      'password' => bcrypt('12345678'),
      'phone' => '01129508321',
      'is_super_admin' => true,
    ]);
  }
}