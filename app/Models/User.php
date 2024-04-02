<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use App\Models\Traits\FilamentTrait;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;
    use FilamentTrait;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'slug',
        'gender',
        'title',
        'first_name',
        'last_name',
        'email',
        'website',
        'description',
        'password',
        'profile_photo_path',
        'wp_id',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function syncs()
    {
        return $this->morphMany(Sync::class, 'syncable');
    }

    public function platforms()
    {
        return $this->morphMany(Platform::class, 'platformable');
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
