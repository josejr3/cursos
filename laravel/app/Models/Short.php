<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'url',
    ];

    protected function embedUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->resolveEmbedUrl(),
        );
    }

    protected function resolveEmbedUrl(): string
    {
        $url = (string) $this->url;
        $host = strtolower((string) parse_url($url, PHP_URL_HOST));
        $path = (string) parse_url($url, PHP_URL_PATH);
        $videoId = null;

        if (str_contains($host, 'youtu.be')) {
            $videoId = trim($path, '/');
        }

        if (! $videoId && str_contains($host, 'youtube.com')) {
            parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;

            if (! $videoId && str_contains($path, '/shorts/')) {
                $videoId = basename($path);
            }
        }

        return filled($videoId)
            ? "https://www.youtube-nocookie.com/embed/{$videoId}"
            : '';
    }
}