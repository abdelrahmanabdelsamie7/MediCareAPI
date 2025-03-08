<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder {
  public function run() {
    User::create([
      'name' => 'مصطفي',
      'email' => 'mostafa@medicare.com',
      'password' => bcrypt('12345678'),
      'phone' => '0123456789'
    ]);
  }
}