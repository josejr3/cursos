<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class GeminiChat extends Component
{
    public array $messages = [];
    public string $newMessage = '';
    public string $currentPrompt = '';
    public bool $isWaiting = false;
    public string $contextText = '';

    public function mount()
    {
        // Intentamos cargar desde la misma carpeta del archivo .php
        $filePath = __DIR__ . '/gemini.txt';

        if (file_exists($filePath)) {
            $this->contextText = file_get_contents($filePath);
        }
    }

    public function sendMessage()
    {
        if ($this->isWaiting || trim($this->newMessage) === '') {
            return;
        }

        $this->messages[] = ['role' => 'user', 'content' => $this->newMessage];
        $this->currentPrompt = $this->newMessage;
        $this->newMessage = '';
        $this->isWaiting = true;

        $this->dispatch('trigger-api');
    }

    #[\Livewire\Attributes\On('trigger-api')]
    public function fetchGeminiResponse()
    {
        $apiKey = Config::get('services.gemini.api_key');
        $models = Config::get('services.gemini.models');

        // VERIFICACIÓN DE DATOS (Si esto falla, la IA no sabrá nada)
        $charCount = strlen($this->contextText);
        if ($charCount < 20) {
            $this->addAiMessage("Error al cargar dato");
            $this->isWaiting = false;
            return;
        }

        // Intentar con cada modelo
        foreach ($models as $model) {
            $isGemma = str_contains($model, 'gemma');

            // Mismo prompt estructurado para todos los modelos
            $prompt = <<<EOT
Eres el asistente oficial del Talent Camp School Responde dudas basándote SOLO en las [BASES].
Si la respuesta no está, di: "Lo siento, no puedo ayudarte con eso".

[BASES]
{$this->contextText}

[PREGUNTA]
{$this->currentPrompt}

Respuesta:
EOT;

            try {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
                
                $response = Http::timeout(180)->post($url, [
                    'contents' => [
                        ['role' => 'user', 'parts' => [['text' => $prompt]]]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.1,
                        'maxOutputTokens' => 1000,
                    ]
                ]);

                if ($response->successful()) {
                    $responseData = $response->json();
                    $aiText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Sin respuesta.';
                    $this->addAiMessage(trim($aiText));
                    $this->isWaiting = false;
                    return;
                } else {
                    $errorData = $response->json();
                    $errorMsg = $errorData['error']['message'] ?? 'Error desconocido';
                    
                    // Errores temporales o de disponibilidad - intentar siguiente modelo
                    $tempErrors = ['quota', 'not found', 'not supported', 'high demand', 'temporarily unavailable', 'overloaded', 'rate limit'];
                    $isTempError = false;
                    foreach ($tempErrors as $err) {
                        if (str_contains(strtolower($errorMsg), strtolower($err))) {
                            $isTempError = true;
                            break;
                        }
                    }
                    
                    if ($isTempError) {
                        continue;
                    }
                    
                    // Otro error, mostrar y terminar
                    $this->addAiMessage("Error: " . $errorMsg);
                    $this->isWaiting = false;
                    return;
                }
            } catch (\Throwable $e) {
                continue;
            }
        }

        // Si llegamos aquí, ningún modelo funcionó
        $this->addAiMessage("Error: Se agotaron todos los modelos disponibles.");
        $this->isWaiting = false;
    }

    private function addAiMessage($text)
    {
        $this->messages[] = ['role' => 'ai', 'content' => $text];
    }

    public function render()
    {
        return view('livewire.gemini-chat');
    }
}