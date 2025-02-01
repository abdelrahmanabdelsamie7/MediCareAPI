<?php
namespace Database\Seeders;
use App\Models\Department;
use Illuminate\Database\Seeder;
class DepartmentSeeder extends Seeder {
  public function run() {
    Department::create([
      'title' => 'الجهاز الهضمي والإخراج',
      'description' => 'متخصص في تشخيص وعلاج أمراض الجهاز الهضمي مثل قرحة المعدة، القولون، وأمراض الكبد',
      'icon' => 'https://cdn-icons-png.freepik.com/256/4615/4615540.png'
    ]);
  }
}
