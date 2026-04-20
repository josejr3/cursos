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
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemma-3-27b-it:generateContent?key=' . $apiKey;

        // VERIFICACIÓN DE DATOS (Si esto falla, la IA no sabrá nada)
        $charCount = strlen($this->contextText);
        if ($charCount < 20) {
            $this->addAiMessage("DEBUG: El archivo gemini.txt no se leyó correctamente o está casi vacío (Letras: $charCount). Revisa la ubicación.");
            $this->isWaiting = false;
            return;
        }

        $structuredPrompt = <<<EOT
Eres el asistente oficial del Talent Camp. Responde dudas basándote SOLO en las [BASES].
Si la respuesta no está, di: "Lo siento, no tengo esa información en las bases".

[BASES]
{$this->contextText}

[PREGUNTA]
{$this->currentPrompt}

Respuesta:
EOT;

        try {
            // Aumentamos el timeout a 180 segundos por si el documento es muy largo
            $response = Http::timeout(180)->post($url, [
                'contents' => [
                    ['role' => 'user', 'parts' => [['text' => $structuredPrompt]]]
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
            } else {
                // Si la API responde con error, lo capturamos aquí
                $errorData = $response->json();
                $errorMsg = $errorData['error']['message'] ?? 'Error desconocido';
                $this->addAiMessage("Error de la API de Google: " . $errorMsg);
            }
        } catch (\Throwable $e) {
            // Si el servidor PHP corta la conexión o hay un problema de red
            $this->addAiMessage("Error técnico de conexión: " . $e->getMessage());
        }

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