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

    public function sendMessage()
    {
        if ($this->isWaiting || trim($this->newMessage) === '') {
            return;
        }

        $this->messages[] = [
            'role' => 'user',
            'content' => $this->newMessage,
        ];

        $this->currentPrompt = $this->newMessage;
        $this->newMessage = '';
        $this->isWaiting = true;

        $this->dispatch('trigger-api');
    }

    #[\Livewire\Attributes\On('trigger-api')]
    public function fetchGeminiResponse()
    {
        $apiKey = Config::get('services.gemini.api_key');
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey;

        try {
            $response = Http::timeout(60)->withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $this->currentPrompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                $aiText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Error al leer la respuesta';

                $this->messages[] = [
                    'role' => 'ai',
                    'content' => $aiText,
                ];
            } else {
                $this->messages[] = [
                    'role' => 'ai',
                    'content' => 'Error de API: ' . $response->status(),
                ];
            }
        } catch (\Throwable $e) {
            $this->messages[] = [
                'role' => 'ai',
                'content' => 'Se agotó el tiempo de espera o falló la conexión.'.$e->getMessage(),
            ];
        }

        $this->isWaiting = false;
    }

    public function render()
    {
        return view('livewire.gemini-chat');
    }
}