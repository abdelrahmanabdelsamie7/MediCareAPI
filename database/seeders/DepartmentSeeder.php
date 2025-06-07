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
            'description' => 'متخصص في تشخيص وعلاج أمراض الجهاز الهضمي مثل قرحة المعدة، القولون، وأمراض الكبد.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/12034/12034614.png'
        ]);

        Department::create([
            'title' => 'الأمراض الباطنية',
            'description' => 'يعنى بتشخيص وعلاج الأمراض التي تصيب الأعضاء الداخلية مثل السكري وارتفاع ضغط الدم.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/12034/12034598.png'
        ]);

        Department::create([
            'title' => 'طب الأطفال',
            'description' => 'يتخصص في علاج الأطفال من جميع الأعمار ويشمل الأمراض الشائعة وأمراض النمو.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/17438/17438216.png'
        ]);

        Department::create([
            'title' => 'النساء والتوليد',
            'description' => 'يختص بتقديم الرعاية الصحية للنساء في جميع مراحل حياتهن، من الفحوصات الروتينية إلى الولادة.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/18130/18130605.png'
        ]);

        Department::create([
            'title' => 'القلب والأوعية الدموية',
            'description' => 'يتمحور حول تشخيص وعلاج أمراض القلب والشرايين مثل الذبحة الصدرية والجلطات القلبية.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/9259/9259768.png'
        ]);

        Department::create([
            'title' => 'العظام والمفاصل',
            'description' => 'يتخصص في علاج مشاكل العظام والمفاصل مثل الكسور، التهاب المفاصل، والانزلاق الغضروفي.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/18130/18130001.png'
        ]);

        Department::create([
            'title' => 'الجلدية والتجميل',
            'description' => 'يتعامل مع الأمراض الجلدية مثل حب الشباب، البهاق، وجراحة التجميل.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/10968/10968806.png'
        ]);

        Department::create([
            'title' => 'العيون',
            'description' => 'تخصص في علاج مشاكل العين مثل قصر النظر، طول النظر، المياه البيضاء والزرقاء.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/9259/9259816.png'
        ]);

        Department::create([
            'title' => 'الأورام',
            'description' => 'يختص بتشخيص وعلاج السرطان باستخدام أحدث الأساليب العلاجية مثل العلاج الكيميائي والإشعاعي.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/18265/18265644.png'
        ]);

        Department::create([
            'title' => 'الأسنان',
            'description' => 'يهتم بصحة الفم والأسنان من علاج تسوس الأسنان إلى تقويم الأسنان والجراحة الفموية.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/9534/9534785.png'
        ]);

        Department::create([
            'title' => 'الأنف والأذن والحنجرة',
            'description' => 'يتعامل مع أمراض الأنف، الأذن، والحنجرة مثل الحساسية، التهابات الجيوب الأنفية، وضعف السمع.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/10606/10606561.png'
        ]);

        Department::create([
            'title' => 'المخ والأعصاب',
            'description' => 'يتخصص في تشخيص وعلاج أمراض الدماغ، الحبل الشوكي، والأعصاب الطرفية مثل الصرع والجلطات الدماغية.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/17275/17275919.png'
        ]);

        Department::create([
            'title' => 'الكلى والمسالك البولية',
            'description' => 'يعالج أمراض الكلى والمثانة مثل الحصوات، التهابات المسالك، والفشل الكلوي.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/9259/9259791.png'
        ]);

        Department::create([
            'title' => 'الطب النفسي',
            'description' => 'يهتم بتشخيص وعلاج الاضطرابات النفسية مثل الاكتئاب، القلق، الفصام، واضطرابات النوم.',
            'icon' => 'https://cdn-icons-png.freepik.com/128/18300/18300024.png'
        ]);

    }
}
