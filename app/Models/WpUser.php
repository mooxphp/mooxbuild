<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WpUser extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_login',
        'user_pass',
        'user_nicename',
        'user_email',
        'user_url',
        'user_registered',
        'user_activation_key',
        'user_status',
        'display_name',
        'spam',
        'deleted',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'wp_users';

    public $timestamps = false;

    protected $casts = [
        'user_registered' => 'datetime',
        'spam' => 'boolean',
        'deleted' => 'boolean',
    ];
}
