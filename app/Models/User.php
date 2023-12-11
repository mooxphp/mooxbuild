<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Traits\FilamentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use FilamentTrait;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use Searchable;
    use TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password', 'whitelist_id'];

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

    public function subscriber()
    {
        return $this->hasOne(Subscriber::class);
    }

    public function whitelist()
    {
        return $this->belongsTo(Whitelist::class);
    }

    public function bypassTokens()
    {
        return $this->hasMany(BypassToken::class);
    }

    public function platforms()
    {
        return $this->morphToMany(Platform::class, 'platformable');
    }

    public function isSuperAdmin(): bool
    {
        return in_array($this->email, config('auth.super_admins'));
    }
}
