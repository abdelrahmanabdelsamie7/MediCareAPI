<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MedicineController extends Controller
{
    public function getDetails(Request $request, $name)
    {
        if (empty(trim($name))) {
            return response()->json([
                'success' => false,
                'message' => 'اسم الدواء لا يمكن أن يكون فارغًا.'
            ], 400);
        }

        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'مفتاح API غير مُعرف.'
            ], 500);
        }

        $prompt = <<<EOD
            قدم معلومات مفصلة عن الدواء '$name' باللغة العربية فقط. قم بتضمين الأقسام التالية:
            1. "medicineName": اسم الدواء باللغة الإنجليزية (كما هو مدخل).
            2. "medicineNameArabic": اسم الدواء باللغة العربية.
            3. "indications": دواعي استعمال الدواء.
            4. "dosageInstructions": تعليمات الجرعة، بما في ذلك الكمية والتكرار.
            5. "sideEffects": الآثار الجانبية المحتملة.
            6. "precautions": التحذيرات والاحتياطات الأمنية.
            7. "additionalInformation": أي تفاصيل إضافية، مثل تعليمات التخزين أو الأسماء البديلة.
            8. "disclaimer": تنبيه يوضح أن هذه المعلومات لأغراض إعلامية وليست بديلاً عن استشارة طبية.

            أرجع الرد ككائن JSON.
            EOD;

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في جلب تفاصيل الدواء من خدمة الذكاء الاصطناعي.'
            ], 500);
        }

        $text = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
        $cleanedText = trim($text, "```json\n```");
        $details = json_decode($cleanedText, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($details)) {
            return response()->json([
                'success' => false,
                'message' => 'صيغة الرد من خدمة الذكاء الاصطناعي غير صالحة.'
            ], 500);
        }

        if (isset($details['success']) && $details['success'] === false) {
            return response()->json($details, 404);
        }

        $defaultFields = [
            'medicineName' => $name,
            'medicineNameArabic' => $name,
            'indications' => 'غير متوفر',
            'dosageInstructions' => 'غير متوفر',
            'sideEffects' => 'غير متوفر',
            'precautions' => 'غير متوفر',
            'additionalInformation' => 'غير متوفر',
            'disclaimer' => 'هذه المعلومات مقدمة لأغراض إعلامية فقط ولا ينبغي اعتبارها بديلاً عن النصيحة الطبية المهنية.'
        ];

        $details = array_merge($defaultFields, $details);

        // تنظيف النصوص من التنسيقات غير المرغوبة
        foreach (['indications', 'dosageInstructions', 'sideEffects', 'precautions', 'additionalInformation'] as $field) {
            if (!empty($details[$field]) && is_string($details[$field])) {
                $details[$field] = $this->cleanText($details[$field]);
            }
        }

        $details['success'] = true;

        return response()->json($details, 200);
    }

    private function cleanText($text)
    {
        $text = preg_replace('/\*\s*/', '', $text);
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);

        return trim($text);
    }
}

