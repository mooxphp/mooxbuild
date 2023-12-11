<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Whitelist extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['comment', 'ip-address', 'lookup', 'expires'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'expires' => 'datetime',
    ];

    public function created_by()
    {
        return $this->hasOne(User::class, 'whitelist_id');
    }
}
