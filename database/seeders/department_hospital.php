<?php
namespace Database\Seeders;
use App\Models\Department;
use App\Models\Hospital;
use Illuminate\Database\Seeder;
class DepartmentHospitalSeeder extends Seeder {
  public function run() {
    $department = Department::first();
    $hospital = Hospital::first();

    $hospital->departments()->attach($department->id, [
      'app_price' => 450.00,
      'start_at' => '2025-01-20 09:00:00',
      'end_at' => '2025-01-31 05:00:00'
    ]);
  }
}
