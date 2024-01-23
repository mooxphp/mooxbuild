<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Platform extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'master',
        'title',
        'slug',
        'bind_to_domain',
        'thumbnail',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'master' => 'boolean',
    ];

    public function syncs()
    {
        return $this->hasMany(Sync::class, 'source_platform_id');
    }

    public function syncs2()
    {
        return $this->hasMany(Sync::class, 'target_platform_id');
    }
}
