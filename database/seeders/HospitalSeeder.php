<?php
namespace Database\Seeders;
use App\Models\Hospital;
use Illuminate\Database\Seeder;
class HospitalSeeder extends Seeder {
  public function run() {
      Hospital::create([
            'title' => 'مستشفى نور الحياة التخصصي',
            'service' => 'جميع التخصصات الطبية، طوارئ 24 ساعة يوميًا',
            'image' => null,
            'phone' => '0934293942',
            'address' => 'طهطا، شارع ٢٨ أمام مدرسة الشهيد علاء البناء، أمام موقف بنجا',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى مصر',
            'service' => 'تقديم خدمات صحية متميزة وذات جودة عالية لمرضى الصعيد',
            'image' => null,
            'phone' => null,
            'address' => '45 ش مصنع الهدرجة، متفرع من شارع الكورنيش الشرقي، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى دار الشفاء للأطفال وحديثي الولادة',
            'service' => 'أفضل الأجهزة والمعدات الطبية لعمل الفحص الطبي الدقيق',
            'image' => null,
            'phone' => null,
            'address' => 'ميدان الثقافة، برج الخليفة، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى مكة التخصصي',
            'service' => 'تقديم خدمات صحية متميزة وذات جودة عالية لمرضى الصعيد',
            'image' => null,
            'phone' => '0934678520',
            'address' => 'جرجا، أمام نقطة المرور، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى السلامة',
            'service' => 'جميع التخصصات الطبية، طوارئ 24 ساعة يوميًا',
            'image' => null,
            'phone' => null,
            'address' => 'أخميم، الخلوة، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى الحياة الدولي',
            'service' => 'أرقى مستشفى في صعيد مصر',
            'image' => null,
            'phone' => '01028090700',
            'address' => 'الغزل، برج الشرطة القبلي، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى ابن سينا التخصصي',
            'service' => 'طوارئ 24 ساعة',
            'image' => null,
            'phone' => '0932116854',
            'address' => 'أمام ميدان العارف، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى الأمل التخصصي',
            'service' => 'طوارئ 24 ساعة',
            'image' => null,
            'phone' => '0932315064',
            'address' => 'شارع 15، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى راشد التخصصي',
            'service' => 'توفير كامل الخدمات والرعاية الطبية 24 ساعة، عيادات تخصصية شاملة',
            'image' => null,
            'phone' => null,
            'address' => 'مدينة ناصر، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى طيبة رويال',
            'service' => 'إحدى المؤسسات الرائدة في المجال الطبي والصحي في صعيد مصر، وحدة الاستقبال والطوارئ 24 ساعة',
            'image' => null,
            'phone' => null,
            'address' => 'سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى النور لطب وجراحات الأطفال المتخصصة',
            'service' => 'استقبال حالات الطوارئ 24 ساعة',
            'image' => null,
            'phone' => '01092282819',
            'address' => 'أمام كوبري الروافع، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى المنشاة المركزي',
            'service' => 'جميع التخصصات الطبية، طوارئ 24 ساعة يوميًا',
            'image' => null,
            'phone' => '0932185083',
            'address' => 'شارع عبد المنعم رياض، بجوار المصرية للاتصالات، المنشاة، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى الخلوتية',
            'service' => 'جميع التخصصات ونخبة من الأطباء على مستوى عالٍ من الخبرة',
            'image' => null,
            'phone' => null,
            'address' => 'شارع بورسعيد، جرجا، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى جزيرة شندويل المركزي',
            'service' => 'خدمات طبية متنوعة',
            'image' => null,
            'phone' => '0932470023',
            'address' => 'طريق سوهاج أسيوط، قرية جزيرة شندويل، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى ساقلتة المركزي',
            'service' => 'خدمات طبية متنوعة',
            'image' => null,
            'phone' => '0932511950',
            'address' => 'شارع التحرير، بجوار مدرسة ساقلتة الإعدادية بنات، ساقلتة، سوهاج',
            'locationUrl' => null
        ]);

        Hospital::create([
            'title' => 'مستشفى أخميم المركزي',
            'service' => 'خدمات طبية متنوعة',
            'image' => null,
            'phone' => '0932589263',
            'address' => 'طريق ناصر الزراعي، بجوار مطرانية الأقباط الأرثوذكسية، أخميم، سوهاج',
            'locationUrl' => null
        ]) ; 
  }
}