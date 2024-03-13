<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'event',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'batch_uuid',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'activity_log';

    protected $casts = [
        'properties' => 'array',
    ];

    public function subject()
    {
        return $this->morphOne(ActivityLog::class, 'subject');
    }

    public function causer()
    {
        return $this->morphOne(ActivityLog::class, 'causer');
    }
}
