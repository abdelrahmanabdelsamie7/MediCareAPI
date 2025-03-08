<?php
namespace Database\Seeders;
use App\Models\Tip;
use App\Models\Department;
use Illuminate\Database\Seeder;
class DepartmentTipSeeder extends Seeder
{
    public function run()
    {
        // قسم الجهاز الهضمي والإخراج
        $department_gastro = Department::where('title', 'الجهاز الهضمي والإخراج')->first();
        Tip::create([
            'question' => 'ما هي أعراض قرحة المعدة؟',
            'answer' => 'ألم في أعلى البطن، حرقة، غثيان.',
            'department_id' => $department_gastro->id
        ]);
        // أضف باقي النصائح لجهاز الهضم كما تم سابقًا...

        // قسم أمراض القلب
        $department_heart = Department::where('title', 'أمراض القلب')->first();
        Tip::create([
            'question' => 'ما هي أعراض النوبة القلبية؟',
            'answer' => 'ألم في الصدر، ضيق في التنفس، تعرق شديد.',
            'department_id' => $department_heart->id
        ]);
        // أضف باقي النصائح للقلب هنا...

        // قسم أمراض السكر
        $department_diabetes = Department::where('title', 'أمراض السكر')->first();
        Tip::create([
            'question' => 'كيف يمكن التحكم في مستوى السكر؟',
            'answer' => 'من خلال تنظيم النظام الغذائي، ممارسة الرياضة، وتناول الأدوية الموصوفة.',
            'department_id' => $department_diabetes->id
        ]);
        // أضف باقي النصائح لمرض السكر هنا...

        // قسم أمراض العيون
        $department_eyes = Department::where('title', 'أمراض العيون')->first();
        Tip::create([
            'question' => 'كيف يمكن الوقاية من مشاكل العين؟',
            'answer' => 'ارتداء النظارات الشمسية، تناول غذاء غني بفيتامين A، والحفاظ على فحص العين الدوري.',
            'department_id' => $department_eyes->id
        ]);
        // أضف باقي النصائح للعيون هنا...

        // قسم الأمراض الجلدية
        $department_skin = Department::where('title', 'الأمراض الجلدية')->first();
        Tip::create([
            'question' => 'كيف أقي نفسي من حب الشباب؟',
            'answer' => 'تنظيف الوجه بانتظام، تجنب المواد الكيميائية القاسية، واستخدام منتجات مناسبة للبشرة.',
            'department_id' => $department_skin->id
        ]);
       // أضف باقي النصائح للبشرة هنا...

        // قسم الأمراض النفسية
        $department_psyche = Department::where('title', 'الأمراض النفسية')->first();
        Tip::create([
            'question' => 'كيف يمكنني التعامل مع القلق؟',
            'answer' => 'ممارسة التنفس العميق، التمارين الرياضية، والحديث مع مختصين يمكن أن يساعد في تقليل القلق.',
            'department_id' => $department_psyche->id
        ]);
        // أضف باقي النصائح للأمراض النفسية هنا...
    }

}