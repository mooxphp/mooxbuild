<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sync extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'syncable_id',
        'syncable_type',
        'source_platform_id',
        'target_platform_id',
        'last_sync',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'last_sync' => 'datetime',
    ];

    public function sourcePlatform()
    {
        return $this->belongsTo(Platform::class, 'source_platform_id');
    }

    public function targetPlatform()
    {
        return $this->belongsTo(Platform::class, 'target_platform_id');
    }

    public function syncable()
    {
        return $this->morphTo();
    }
}
