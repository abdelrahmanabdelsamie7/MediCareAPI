<?php
namespace Database\Seeders;
use App\Models\Department;
use Illuminate\Database\Seeder;
class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'title' => 'الجهاز الهضمي والإخراج',
            'description' => 'متخصص في تشخيص وعلاج أمراض الجهاز الهضمي مثل قرحة المعدة، القولون، وأمراض الكبد',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4615/4615540.png'
        ]);

        Department::create([
            'title' => 'الأمراض الباطنية',
            'description' => 'يعنى بتشخيص وعلاج الأمراض التي تصيب الأعضاء الداخلية مثل السكري وارتفاع ضغط الدم',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4624/4624219.png'
        ]);

        Department::create([
            'title' => 'الأطفال',
            'description' => 'يتخصص في علاج الأطفال من جميع الأعمار ويشمل الأمراض الشائعة وأمراض النمو',
            'icon' => 'https://cdn-icons-png.freepik.com/256/3740/3740742.png'
        ]);

        Department::create([
            'title' => 'النساء والتوليد',
            'description' => 'يختص بتقديم الرعاية الصحية للنساء في جميع مراحل حياتهن، من الفحوصات الروتينية إلى الولادة',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4630/4630160.png'
        ]);

        Department::create([
            'title' => 'القلب والأوعية الدموية',
            'description' => 'يتمحور حول تشخيص وعلاج أمراض القلب والشرايين مثل الذبحة الصدرية والجلطات القلبية',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4615/4615565.png'
        ]);

        Department::create([
            'title' => 'العظام والمفاصل',
            'description' => 'يتخصص في علاج مشاكل العظام والمفاصل مثل الكسور، التهاب المفاصل، والانزلاق الغضروفي',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4620/4620549.png'
        ]);

        Department::create([
            'title' => 'الجلدية والتجميل',
            'description' => 'يتعامل مع الأمراض الجلدية مثل حب الشباب، البهاق، وجراحة التجميل',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4630/4630411.png'
        ]);

        Department::create([
            'title' => 'العيون',
            'description' => 'تخصص في علاج مشاكل العين مثل قصر النظر، طول النظر، المياه البيضاء والزرقاء',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4641/4641625.png'
        ]);

        Department::create([
            'title' => 'الأورام',
            'description' => 'يختص بتشخيص وعلاج السرطان باستخدام أحدث الأساليب العلاجية مثل العلاج الكيميائي والإشعاعي',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4615/4615509.png'
        ]);

        Department::create([
            'title' => 'الأسنان',
            'description' => 'يهتم بصحة الفم والأسنان من علاج تسوس الأسنان إلى تقويم الأسنان والجراحة الفموية',
            'icon' => 'https://cdn-icons-png.freepik.com/256/4615/4615397.png'
        ]);

    }
}