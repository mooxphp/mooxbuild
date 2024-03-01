<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
