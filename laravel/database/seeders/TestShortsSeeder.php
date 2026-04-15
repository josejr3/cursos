<?php

namespace Database\Seeders;

use App\Models\Short;
use Illuminate\Database\Seeder;

class TestShortsSeeder extends Seeder
{
    /**
     * Seed sample YouTube Shorts for local testing.
     */
    public function run(): void
    {
        $shorts = [
            [
                'titulo' => 'Tip rapido: route model binding',
                'url' => 'https://www.youtube.com/shorts/9Aw2RjIuCLc',
            ],
            [
                'titulo' => 'Atajo para depurar consultas Eloquent',
                'url' => 'https://www.youtube.com/shorts/xlZl8UEvtpY',
            ],
            [
                'titulo' => 'Validaciones utiles en formularios',
                'url' => 'https://www.youtube.com/shorts/VdHgRJlO2TM',
            ],
            [
                'titulo' => 'Livewire en 40 segundos',
                'url' => 'https://www.youtube.com/shorts/fH4oK0fArvs',
            ],
        ];

        foreach ($shorts as $short) {
            Short::updateOrCreate(
                ['titulo' => $short['titulo']],
                ['url' => $short['url']]
            );
        }
    }
}
