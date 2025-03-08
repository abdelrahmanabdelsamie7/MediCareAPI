<?php
namespace Database\Seeders;
use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Database\Seeder;
class DoctorSeeder extends Seeder
{
    public function run()
    {
        // البحث عن الأقسام الخاصة بالطبيب من الجدول Departments
       $department_gastro = Department::where('title', 'أمراض الجهاز الهضمي')->first();

if (!$department_gastro) {
    echo "قسم 'أمراض الجهاز الهضمي' غير موجود في قاعدة البيانات.";
    return;
}

Doctor::create([
    'fName' => 'محمد',
    'lName' => 'إبراهيم',
    'gender' => 'male',
    'birthDate' => '1985-03-10',
    'phone' => '01123456789',
    'image' => 'https://path_to_image.jpg',
    'whatsappLink' => 'https://wa.me/01123456789',
    'facebookLink' => 'https://facebook.com/doctor.mohamed',
    'title' => 'أستاذ أمراض الجهاز الهضمي',
    'infoAboutDoctor' => 'دكتور متخصص في أمراض الجهاز الهضمي مثل القولون وقرحة المعدة',
    'app_price' => 100.00,
    'homeOption' => true,
    'avg_rate' => 4.5,
    'email' => 'mohamed.ibrahim@gmail.com',
    'password' => bcrypt('password'),
    'department_id' => $department_gastro->id,
    'status' => true
]);

        $department_heart = Department::where('title', 'أمراض القلب')->first();
        $department_eye = Department::where('title', 'أمراض العيون')->first();
        $department_skin = Department::where('title', 'الأمراض الجلدية')->first();
        $department_kids = Department::where('title', 'طب الأطفال')->first();
        $department_neuro = Department::where('title', 'أمراض الأعصاب')->first();
        $department_orthopedic = Department::where('title', 'جراحة العظام')->first();
     

        Doctor::create([
            'fName' => 'سارة',
            'lName' => 'حسن',
            'gender' => 'female',
            'birthDate' => '1990-07-15',
            'phone' => '01234567890',
            'image' => 'https://path_to_image.jpg',
            'whatsappLink' => 'https://wa.me/01234567890',
            'facebookLink' => 'https://facebook.com/dr.sara',
            'title' => 'أخصائية أمراض القلب',
            'infoAboutDoctor' => 'دكتورة متخصصة في أمراض القلب ومتابعة الحالة الصحية للقلب',
            'app_price' => 150.00,
            'homeOption' => false,
            'avg_rate' => 4.7,
            'email' => 'sara.hassan@gmail.com',
            'password' => bcrypt('password'),
            'department_id' => $department_heart->id,
            'status' => true
        ]);

        Doctor::create([
            'fName' => 'أحمد',
            'lName' => 'جمال',
            'gender' => 'male',
            'birthDate' => '1982-11-20',
            'phone' => '01012345678',
            'image' => 'https://path_to_image.jpg',
            'whatsappLink' => 'https://wa.me/01012345678',
            'facebookLink' => 'https://facebook.com/doctor.ahmed',
            'title' => 'أخصائي أمراض العيون',
            'infoAboutDoctor' => 'دكتور متخصص في أمراض العيون مثل ضعف البصر والمياه البيضاء',
            'app_price' => 120.00,
            'homeOption' => false,
            'avg_rate' => 4.6,
            'email' => 'ahmed.jamal@gmail.com',
            'password' => bcrypt('password'),
            'department_id' => $department_eye->id,
            'status' => true
        ]);

        Doctor::create([
            'fName' => 'منى',
            'lName' => 'عبدالرحمن',
            'gender' => 'female',
            'birthDate' => '1988-05-25',
            'phone' => '01098765432',
            'image' => 'https://path_to_image.jpg',
            'whatsappLink' => 'https://wa.me/01098765432',
            'facebookLink' => 'https://facebook.com/dr.mona',
            'title' => 'دكتورة أمراض جلدية',
            'infoAboutDoctor' => 'دكتورة متخصصة في الأمراض الجلدية مثل حب الشباب والأكزيما',
            'app_price' => 100.00,
            'homeOption' => true,
            'avg_rate' => 4.8,
            'email' => 'mona.abdelrahman@gmail.com',
            'password' => bcrypt('password'),
            'department_id' => $department_skin->id,
            'status' => true
        ]);

        Doctor::create([
            'fName' => 'علي',
            'lName' => 'حسن',
            'gender' => 'male',
            'birthDate' => '1987-12-12',
            'phone' => '01112223344',
            'image' => 'https://path_to_image.jpg',
            'whatsappLink' => 'https://wa.me/01112223344',
            'facebookLink' => 'https://facebook.com/doctor.ali',
            'title' => 'أستاذ طب الأطفال',
            'infoAboutDoctor' => 'دكتور متخصص في طب الأطفال ومتابعة التطورات الصحية للأطفال',
            'app_price' => 130.00,
            'homeOption' => false,
            'avg_rate' => 4.9,
            'email' => 'ali.hassan@gmail.com',
            'password' => bcrypt('password'),
            'department_id' => $department_kids->id,
            'status' => true
        ]);

        Doctor::create([
            'fName' => 'مريم',
            'lName' => 'عادل',
            'gender' => 'female',
            'birthDate' => '1992-09-10',
            'phone' => '01199887766',
            'image' => 'https://path_to_image.jpg',
            'whatsappLink' => 'https://wa.me/01199887766',
            'facebookLink' => 'https://facebook.com/dr.mariam',
            'title' => 'أخصائية أمراض الأعصاب',
            'infoAboutDoctor' => 'دكتورة متخصصة في علاج الأمراض العصبية مثل الصداع النصفي والصرع',
            'app_price' => 140.00,
            'homeOption' => false,
            'avg_rate' => 4.3,
            'email' => 'mariam.adel@gmail.com',
            'password' => bcrypt('password'),
            'department_id' => $department_neuro->id,
            'status' => true
        ]);

        Doctor::create([
            'fName' => 'خالد',
            'lName' => 'عامر',
            'gender' => 'male',
            'birthDate' => '1985-03-14',
            'phone' => '01234567890',
            'image' => 'https://path_to_image.jpg',
            'whatsappLink' => 'https://wa.me/01234567890',
            'facebookLink' => 'https://facebook.com/doctor.khaled',
            'title' => 'أخصائي جراحة العظام',
            'infoAboutDoctor' => 'دكتور متخصص في جراحة العظام وعلاج الكسور والمفاصل',
            'app_price' => 160.00,
            'homeOption' => true,
            'avg_rate' => 4.2,
            'email' => 'khaled.amer@gmail.com',
            'password' => bcrypt('password'),
            'department_id' => $department_orthopedic->id,
            'status' => true
        ]);


    }
}