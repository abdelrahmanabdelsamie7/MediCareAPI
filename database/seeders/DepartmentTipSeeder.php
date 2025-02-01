<?php
namespace Database\Seeders;
use App\Models\Tip;
use App\Models\Department;
use Illuminate\Database\Seeder;
class DepartmentTipSeeder extends Seeder {
  public function run() {
    $department = Department::first();

    Tip::create([
      'question' => 'ما هي أعراض قرحة المعدة؟',
      'answer' => 'ألم في أعلى البطن، حرقة، غثيان.',
      'department_id' => $department->id
    ]);
  }
}
