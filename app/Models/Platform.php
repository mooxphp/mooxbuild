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
        'title',
        'slug',
        'domain',
        'selection',
        'order',
        'locked',
        'master',
        'thumbnail',
        'platformable_id',
        'platformable_type',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'selection' => 'boolean',
        'locked' => 'boolean',
        'master' => 'boolean',
    ];

    public function sources()
    {
        return $this->hasMany(Sync::class, 'source_platform_id');
    }

    public function targets()
    {
        return $this->hasMany(Sync::class, 'target_platform_id');
    }

    public function platformable()
    {
        return $this->morphTo();
    }
}
