<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    /**
     * Send a prompt to Gemini and return the text response.
     */
    public function generateText(string $prompt): ?string
    {
        if (empty($this->apiKey)) {
            Log::warning('GEMINI_API_KEY is not set.');
            return null;
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    return trim($data['candidates'][0]['content']['parts'][0]['text']);
                }
            }

            Log::error('Gemini API Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Gemini Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Send a prompt and expect a JSON object back.
     */
    public function generateJson(string $prompt): ?array
    {
        $prompt .= "\n\nIMPORTANT: Return ONLY valid JSON. Do not include any markdown formatting like ```json or ```.";
        
        $text = $this->generateText($prompt);
        if (!$text) return null;

        // Try to clean up the response if Gemini included markdown
        $text = preg_replace('/```json\s*/', '', $text);
        $text = preg_replace('/```\s*/', '', $text);

        $decoded = json_decode(trim($text), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        Log::error('Gemini JSON Parse Error: ' . json_last_error_msg() . ' | Raw: ' . $text);
        return null;
    }
}
