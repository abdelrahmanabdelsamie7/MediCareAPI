<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder {
  public function run() {
    User::create([
      'name' => 'John Doe',
      'email' => 'user@example.com',
      'password' => bcrypt('password'),
      'phone' => '0123456789'
    ]);
  }
}
