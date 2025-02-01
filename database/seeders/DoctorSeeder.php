<?php
namespace Database\Seeders;
use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Database\Seeder;
class DoctorSeeder extends Seeder {
  public function run() {
    $department = Department::first(); // Ensure department exists
    Doctor::create([
      'fName' => 'Mohamed',
      'lName' => 'Ahmed',
      'email' => 'moalidoc@gmail.com',
      'password' => bcrypt('a12345678910'),
      'phone' => '01129508321',
      'title' => 'Gastroenterologist',
      'birthDate' => '2003-05-07',
      'image' => 'doctor-image.jpg',
      'whatsappLink' => 'https://wa.me/201111111111',
      'facebookLink' =>'www.facebook.com/abdelrahman.marey.7',
      'infoAboutDoctor'=>'Dr mohamed is a Gastroenterologist in Cairo, Egypt. He has been practicing for 5 years. He graduated from Cairo University / Faculty of Medicine in 2016 and specializes in gastroenterology.',
      'department_id' => $department->id
    ]);
  }
}
