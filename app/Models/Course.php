<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'url_video',
        'estado',
    ];

    /**
     * Get a thumbnail URL for the course video.
     */
    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->resolveThumbnailUrl(),
        );
    }

    protected function resolveThumbnailUrl(): string
    {
        $url = (string) $this->url_video;
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
            ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"
            : 'https://placehold.co/640x360/0b1220/00ff00?text=Curso';
    }
}