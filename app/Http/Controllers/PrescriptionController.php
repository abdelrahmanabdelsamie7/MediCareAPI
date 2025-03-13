<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PrescriptionController extends Controller
{
    private string $geminiModel = 'gemini-2.0-flash';

    public function analyze(Request $request)
    {
        try {
            $this->validateRequest($request);

            $prompt = $this->buildPrompt();
            $imageData = $this->processImage($request->file('image'));

            $response = $this->callGeminiApi($prompt, $imageData);

            return $this->parseGeminiResponse($response);
        } catch (\Exception $e) {
            Log::error('Prescription Analysis Error: ' . $e->getMessage());
            return response()->json(['error' => 'فشل تحليل الوصفة الطبية. حاول مرة أخرى لاحقًا.'], 500);
        }
    }
  public function getMedicineDetails(Request $request, $name)
  {
      $apiKey = env('GEMINI_API_KEY');
      $prompt = "Provide detailed information about the medicine '$name' in Arabic, including indications (دواعي الاستعمال), dosage instructions (تعليمات الجرعة), side effects (الآثار الجانبية), precautions (الاحتياطات), and additional information (معلومات إضافية). Return the response in JSON format.";

      $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
          'contents' => [
              ['parts' => [['text' => $prompt]]]
          ]
      ]);

      if ($response->failed()) {
          return response()->json(['success' => false, 'message' => 'Failed to fetch medicine details'], 500);
      }

      $text = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
      $details = json_decode(trim($text, "```json\n```"), true);

      if (!$details) {
          return response()->json(['success' => false, 'message' => 'Invalid response format'], 500);
      }

      return response()->json($details);
  }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|max:5000', // Image is now required
        ]);
    }

    private function callGeminiApi(string $prompt, string $imageData): array
    {
        $apiKey = env('GEMINI_API_KEY');
        if (empty($apiKey)) {
            throw new \Exception('Gemini API key is missing. Please configure it in your .env file.');
        }

        $parts = [
            ['inlineData' => ['mimeType' => 'image/jpeg', 'data' => $imageData]],
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
        $instruction = "قم بتحليل صورة الوصفة الطبية واستخرج المعلومات التالية باللغة العربية بتنسيق JSON صالح. ";
        $instruction .= "استخرج تفاصيل الأدوية من الصورة.";

        $responseFormat = "أعد الاستجابة تحتوي على:
            - medications: قائمة الأدوية (كل دواء يحتوي على: name, dosage, frequency, duration, purpose)
            - prescriptionDetails: ملخص الوصفة (مثل اسم الطبيب، تاريخ الوصفة، اسم المريض إن وجد)
            - generalAdvice: نصائح عامة للمريض حول استخدام الدواء
            - إذا لم تكن الصورة وصفة طبية أو غير واضحة، أعد استجابة تحتوي على رسالة خطأ فقط.";

        return $instruction . " " . $responseFormat;
    }

    private function processImage($image): string
    {
        return base64_encode(file_get_contents($image->path()));
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

            $confidenceScore = $json['confidence'] ?? 'غير متوفر';
            $message = is_numeric($confidenceScore)
                ? ($confidenceScore < 50
                    ? "⚠️ النتيجة غير مؤكدة بنسبة كبيرة، تحقق من الوصفة مع صيدلي."
                    : "✅ الذكاء الاصطناعي واثق من تحليل الوصفة.")
                : "⚠️ نسبة الثقة غير متوفرة، تحقق من الوصفة.";

            return [
                'medications' => $this->formatMedications($json['medications'] ?? []),
                'prescriptionDetails' => $json['prescriptionDetails'] ?? 'غير متوفر',
                'generalAdvice' => $json['generalAdvice'] ?? 'تناول الأدوية حسب التعليمات، واستشر الطبيب أو الصيدلي لأي استفسار.',
                'message' => $message,
                'warning' => "⚠️ هذا تحليل آلي، لا تعتمد عليه كبديل لاستشارة طبيب أو صيدلي."
            ];
        } catch (\Exception $e) {
            return $this->fallbackParsing($text);
        }
    }

    private function formatMedications(array $medications): array
    {
        if (empty($medications)) {
            return [['name' => 'غير متوفر', 'dosage' => '', 'frequency' => '', 'duration' => '', 'purpose' => '', 'warnings' => '']];
        }

        return array_map(function ($med) {
            return [
                'name' => $med['name'] ?? 'غير متوفر',
                'dosage' => $med['dosage'] ?? '',
                'frequency' => $med['frequency'] ?? '',
                'duration' => $med['duration'] ?? '',
                'purpose' => $med['purpose'] ?? 'غير محدد',
                'warnings' => $med['warnings'] ?? 'تجنب الجرعة الزائدة واستشر الصيدلي إذا شعرت بأعراض غير طبيعية.'
            ];
        }, $medications);
    }

    private function fallbackParsing(string $text): array
    {
        return [
            'medications' => [['name' => 'غير متوفر', 'dosage' => '', 'frequency' => '', 'duration' => '', 'purpose' => '', 'warnings' => '']],
            'prescriptionDetails' => 'غير متوفر',
            'generalAdvice' => 'تأكد من وضوح الوصفة واستشر صيدليًا للحصول على التفاصيل.',
            'confidence_score' => 'غير متوفر',
            'message' => "⚠️ لم يتمكن النظام من استخراج تفاصيل الوصفة، تأكد من وضوح الصورة.",
            'warning' => "⚠️ هذا تحليل آلي، لا تعتمد عليه كبديل لاستشارة طبيب أو صيدلي."
        ];
    }
}
