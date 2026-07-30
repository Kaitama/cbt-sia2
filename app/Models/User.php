<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// Kebutuhan user avatar atau foto profil



use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;

#[Fillable(['name', 'email', 'password', 'photo_path', 'is_staff'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // autorisasi user yang dapat mengakses panel admin (staff)
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_staff;
    }

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
            'is_staff' => 'boolean',
        ];
    }


    // ubah foto dalam format URL
    public function getFilamentAvatarUrl(): ?string
    {
        if (
            $this->photo_path &&
            Storage::disk('public')->exists($this->photo_path)
        ) {
            return Storage::disk('public')->url($this->photo_path);
        }

        return (new UiAvatarsProvider)->get($this);
    }

}
