<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LabTestController extends Controller
{
    private string $geminiModel = 'gemini-2.0-flash';

    public function analyze(Request $request)
    {
        try {
            $this->validateRequest($request);

            $prompt = $this->buildPrompt();
            $fileData = $this->processFile($request->file('file'));

            $response = $this->callGeminiApi($prompt, $fileData);

            return $this->parseGeminiResponse($response);
        } catch (\Exception $e) {
            Log::error('Lab Test Analysis Error: ' . $e->getMessage());
            return response()->json(['error' => 'فشل تحليل الفحص المختبري. حاول مرة أخرى لاحقًا.'], 500);
        }
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png|max:5000', // Accepts images and PDFs, max 5MB
        ]);
    }

    private function callGeminiApi(string $prompt, string $fileData): array
    {
        $apiKey = env('GEMINI_API_KEY');
        $mimeType = Str::startsWith($fileData, 'data:application/pdf') ? 'application/pdf' : 'image/jpeg';
        $parts = [
            ['inlineData' => ['mimeType' => $mimeType, 'data' => $fileData]],
            ['text' => $prompt]
        ];

        $payload = ['contents' => ['parts' => $parts]];

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$this->geminiModel}:generateContent?key={$apiKey}", $payload);

        if ($response->failed()) {
            throw new \Exception("Gemini API Error: " . $response->body());
        }

        return $response->json();
    }

    private function buildPrompt(): string
    {
        $instruction = " لازم يكون فحص مختبري مش وصفه طبيه او روشته قم بتحليل ملف الفحص المختبري المرفوع (صورة أو PDF) واستخرج المعلومات التالية باللغة العربية بتنسيق JSON صالح. ";
        $instruction .= "حدد الاختبارات الموجودة في التقرير وقيمها، وقدم تفسيرًا طبيًا واقتراحات بناءً على النتائج.";

        $responseFormat = "أعد الاستجابة تحتوي على:
            - testResults: قائمة الاختبارات (كل اختبار يحتوي على: name, value, unit, status [طبيعي /غير طبيعي], notes)
            - interpretation: تفسير طبي للنتائج
            - recommendations: توصيات بناءً على التحليل
            - confidence: نسبة ثقة الذكاء الاصطناعي (رقم بدون علامة %)
            - إذا لم يكن الملف تقرير فحص مختبري أو غير واضح، أعد استجابة تحتوي على رسالة خطأ فقط.";

        return $instruction . " " . $responseFormat;
    }

    private function processFile($file): string
    {
        return base64_encode(file_get_contents($file->path()));
    }

    private function parseGeminiResponse(array $response): array
    {
        $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? '';

        try {
            $json = json_decode($text, true);
            if (!is_array($json)) {
                preg_match('/\{.*\}/s', $text, $matches);
                if (!empty($matches[0])) {
                    $json = json_decode($matches[0], true);
                }
            }

            if (!is_array($json)) {
                return $this->fallbackParsing($text);
            }



            return [
                'testResults' => $this->formatTestResults($json['testResults'] ?? []),
                'interpretation' => $json['interpretation'] ?? 'غير متوفر',
                'recommendations' => $json['recommendations'] ?? 'استشر طبيبًا لمزيد من التقييم.',
                'warning' => "⚠️ هذا تحليل آلي، لا تعتمد عليه كبديل لاستشارة طبيب مختص."
            ];
        } catch (\Exception $e) {
            return $this->fallbackParsing($text);
        }
    }

    private function formatTestResults(array $testResults): array
    {
        if (empty($testResults)) {
            return [['name' => 'غير متوفر', 'value' => '', 'unit' => '', 'status' => '', 'notes' => 'لا توجد نتائج متاحة.']];
        }

        return array_map(function ($result) {
            return [
                'name' => $result['name'] ?? 'غير متوفر',
                'value' => $result['value'] ?? '',
                'unit' => $result['unit'] ?? '',
                'status' => $result['status'] ?? 'غير محدد',
                'notes' => $result['notes'] ?? 'لا توجد ملاحظات إضافية.'
            ];
        }, $testResults);
    }

    private function fallbackParsing(string $text): array
    {
        return [
            'testResults' => [['name' => 'غير متوفر', 'value' => '', 'unit' => '', 'status' => '', 'notes' => 'لا توجد نتائج متاحة.']],
            'interpretation' => 'غير متوفر',
            'recommendations' => 'تأكد من وضوح الملف واستشر طبيبًا للحصول على التفاصيل.',
            'warning' => "⚠️ هذا تحليل آلي، لا تعتمد عليه كبديل لاستشارة طبيب مختص."
        ];
    }
}
