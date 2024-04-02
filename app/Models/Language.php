<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'isocode',
        'flag',
        'active',
        'published',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'active' => 'boolean',
        'published' => 'boolean',
    ];

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }

    public function translations2()
    {
        return $this->hasMany(Translation::class, 'fallback_language_id');
    }
}
