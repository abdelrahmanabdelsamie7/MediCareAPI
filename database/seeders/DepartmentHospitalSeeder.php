<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Hospital;

class DepartmentHospitalSeeder extends Seeder {
  public function run() {
    // Get the first department and hospital
    $department = Department::first();
    $hospital = Hospital::first();

    // Attach the department to the hospital
    $hospital->departments()->attach($department->id, [
      'app_price' => 450.00,
      'start_at' => '2025-01-20 09:00:00',
      'end_at' => '2025-01-31 05:00:00'
    ]);
  }
}
