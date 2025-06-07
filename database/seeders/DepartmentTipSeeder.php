<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class DepartmentTipSeeder extends Seeder
{
    public function run()
    {
        $tips = [
            [
                'id' => Str::uuid(),
                'question' => 'ما هي علامات ضعف النظر؟',
                'answer' => 'تشمل صعوبة القراءة، الصداع، والتحديق لتركيز الرؤية.',
                'department_id' => '44394c36-512c-4263-bc20-e83a9db0f62f', // العيون
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'كيف تحمي عينيك من الأشعة الضارة؟',
                'answer' => 'باستخدام نظارات شمسية تحجب الأشعة فوق البنفسجية.',
                'department_id' => '44394c36-512c-4263-bc20-e83a9db0f62f', // العيون
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'ما أهمية النظافة في استخدام العدسات؟',
                'answer' => 'تقلل من خطر الالتهابات وتحافظ على سلامة العين.',
                'department_id' => '44394c36-512c-4263-bc20-e83a9db0f62f', // العيون
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'كيف تتجنب إجهاد العين عند استخدام الشاشات؟',
                'answer' => 'باتباع قاعدة 20-20-20: كل 20 دقيقة، انظر لـ 20 قدمًا لمدة 20 ثانية.',
                'department_id' => '44394c36-512c-4263-bc20-e83a9db0f62f', // العيون
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'ما هي علامات التهاب الملتحمة؟',
                'answer' => 'عند رؤية ومضات ضوء أو فقدان مفاجئ في الرؤية.',
                'department_id' => '44394c36-512c-4263-bc20-e83a9db0f62f', // العيون
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'ما دور التغذية في صحة العين؟',
                'answer' => 'تناول الأطعمة الغنية بالفيتامينات A وC وE يساعد في الحفاظ على صحة العين.',
                'department_id' => '44394c36-512c-4263-bc20-e83a9db0f62f', // العيون
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'متى يجب مراجعة طبيب العيون فورًا؟',
                'answer' => 'احمرار، حكة، إفرازات من العين.',
                'department_id' => '44394c36-512c-4263-bc20-e83a9db0f62f', // العيون
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'ما أهمية الفحص الدوري؟',
                'answer' => 'يساعد على الكشف المبكر عن الأمراض.',
                'department_id' => 'f1fc8e47-53b7-47a9-bf29-f983c35c5767', // العظام والمفاصل
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'هل النظام الغذائي يؤثر على الصحة؟',
                'answer' => 'نعم، التغذية المتوازنة ضرورية لصحة الجسم.',
                'department_id' => 'f4ca8082-8223-4daa-90c0-331f7293012b', // الطب النفسي
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'question' => 'ما علاقة التوتر بالمشاكل الصحية؟',
                'answer' => 'التوتر المزمن قد يؤدي إلى تفاقم بعض الحالات.',
                'department_id' => '92e7d5a3-3076-4912-a7ba-895d60d0f025', // الجهاز الهضمي والإخراج
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // تابع على نفس النمط لبقية الأقسام
        ];

        DB::table('tips')->insert($tips);
    }
}