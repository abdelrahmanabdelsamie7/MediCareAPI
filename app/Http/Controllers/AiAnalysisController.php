<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AiAnalysisController extends Controller
{
    private string $geminiModel = 'gemini-2.0-flash';
    public function analyze(Request $request)
    {
        try {
            $this->validateRequest($request);

            $prompt = $this->buildPrompt($request->input('text'), $request->hasFile('image'));
            $imageData = $request->hasFile('image') ? $this->processImage($request->file('image')) : null;

            $response = $this->callGeminiApi($prompt, $imageData);

            return $this->parseGeminiResponse($response);
        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            return response()->json(['error' => 'Analysis failed. Please try again later.'], 500);
        }
    }
    private function validateRequest(Request $request)
    {
        $request->validate([
            'text' => 'nullable|string',
            'image' => 'nullable|file|image|max:5000',
        ]);

        if (!$request->has('text') && !$request->hasFile('image')) {
            abort(response()->json(['error' => 'يرجى إدخال الأعراض أو تحميل صورة للتحليل.'], 400));
        }
    }
    private function callGeminiApi(string $prompt, ?string $imageData = null)
    {
        $apiKey = env('GEMINI_API_KEY');
        if (empty($apiKey)) {
            throw new \Exception('Gemini API key is missing. Please configure it in your .env file.');
        }

        $parts = collect([['text' => $prompt]])
            ->when($imageData, fn($collection) => $collection->prepend([
                'inlineData' => [
                    'mimeType' => 'image/jpeg',
                    'data' => $imageData
                ]
            ]))
            ->toArray();

        $payload = ['contents' => ['parts' => $parts]];

        Log::info('Sending request to Gemini API:', [
            'url' => "https://generativelanguage.googleapis.com/v1beta/models/{$this->geminiModel}:generateContent",
            'payload' => $payload,
        ]);

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$this->geminiModel}:generateContent?key={$apiKey}", $payload);

        if ($response->failed()) {
            throw new \Exception("Gemini API Error: " . $response->body());
        }

        return $response->json();
    }
    private function buildPrompt(?string $text, bool $hasImage): string
    {
        $instruction = "";
        if ($hasImage && $text) {
            $instruction = "Analyze the provided image and the following symptoms: $text. If the image is related to health or medical care, include its analysis. Otherwise, ignore the image.";
        } elseif ($hasImage) {
            $instruction = "Analyze the provided image. If it’s related to health or medical care, provide an analysis. Otherwise, indicate it’s not relevant.";
        } elseif ($text) {
            $instruction = "Analyze the following symptoms: $text.";
        }

        $responseFormat = "Return the response in Arabic as a valid JSON object with these keys:
            - imageAnalysis: description of the image (if analyzed)
            - diagnosis: probable diagnosis
            - recommendedSpecialization: suggested medical specialization
            - advice: advice before seeing a doctor
            - confidence: AI confidence percentage (number without % sign)
            - medications: list of suggested medications (each with name, dosage, notes)";

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
            // نحاول تحليل النص كـ JSON مباشرةً
            $json = json_decode($text, true);

            // إذا لم يكن JSON صحيحًا، نحاول استخراجه باستخدام تعبير منتظم
            if (!is_array($json)) {
                preg_match('/\{.*\}/s', $text, $matches);
                if (!empty($matches[0])) {
                    $json = json_decode($matches[0], true);
                }
            }

            // إذا كان التنسيق غير صالح حتى الآن، نستخدم تحليل احتياطي
            if (!is_array($json)) {
                return $this->fallbackParsing($text);
            }

            // التأكد من أن نسبة الثقة موجودة وتحويلها إلى نسبة مئوية
            $confidenceScore = $json['confidence'];
            $message = $confidenceScore < 50 ? "⚠️ النتيجة غير مؤكدة بنسبة كبيرة، يُفضل مراجعة طبيب مختص." : "✅ الذكاء الاصطناعي واثق من هذا التشخيص.";

            return [
                'imageAnalysis' => $json['imageAnalysis'] ?? '',
                'diagnosis' => $json['diagnosis'] ?? 'غير متوفر',
                'recommendedSpecialization' => $json['recommendedSpecialization'] ?? '',
                'advice' => $json['advice'] ?? '',
                'confidence_score' => $confidenceScore,
                'message' => $message,
                'suggested_medications' => isset($json['medications']) && is_array($json['medications'])
                    ? $json['medications']
                    : [['name' => 'غير متوفر', 'dosage' => '', 'notes' => 'لا يوجد اقتراحات متاحة.']],
                'medication_warning' => "⚠️ لا تتناول أي دواء دون الرجوع إلى طبيب مختص."
            ];
        } catch (\Exception $e) {
            return $this->fallbackParsing($text);
        }
    }
    private function fallbackParsing(string $text): array
    {
        return [
            'imageAnalysis' => Str::contains($text, 'imageAnalysis') ? Str::between($text, '"imageAnalysis": "', '"') : '',
            'recommendedSpecialization' => Str::contains($text, 'recommendedSpecialization') ? Str::between($text, '"recommendedSpecialization": "', '"') : '',
            'advice' => Str::contains($text, 'advice') ? Str::between($text, '"advice": "', '"') : '',
            'confidence_score' => 'غير متوفر',
            'message' => "⚠️ لم يتمكن النظام من استخراج نسبة الثقة، يُفضل مراجعة طبيب مختص.",
            'suggested_medications' => ['لا يوجد اقتراحات متاحة.'],
            'medication_warning' => "⚠️ لا تتناول أي دواء دون الرجوع إلى طبيب مختص."
        ];
    }
}
