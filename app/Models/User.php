<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'email';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nombre',
        'apellidos',
        'email',
        'descripcion',
        'profile_photo_path',
        'password',
        'email_verified_at',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Keep compatibility with Laravel auth scaffolding that expects a `name` field.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => trim(($attributes['nombre'] ?? '').' '.($attributes['apellidos'] ?? '')),
            set: function (?string $value): array {
                $value = trim((string) $value);

                if ($value === '') {
                    return [
                        'nombre' => '',
                        'apellidos' => '',
                    ];
                }

                $parts = preg_split('/\s+/', $value, 2);

                return [
                    'nombre' => $parts[0] ?? '',
                    'apellidos' => $parts[1] ?? '',
                ];
            },
        );
    }

    /**
     * Expose the email primary key through the default `id` attribute expected by auth scaffolding.
     */
    protected function id(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): ?string => $attributes['email'] ?? null,
        );
    }

    /**
     * Resolve the profile photo URL with a default fallback image.
     */
    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => filled($attributes['profile_photo_path'] ?? null)
                ? asset('storage/'.$attributes['profile_photo_path'])
                : asset('images/default-avatar.svg'),
        );
    }
}
