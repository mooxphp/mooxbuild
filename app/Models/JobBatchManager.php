<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobBatchManager extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'batch_id',
        'name',
        'total_jobs',
        'pending_jobs',
        'failed_jobs',
        'failed_job_ids',
        'options',
        'cancelled_at',
        'finished_at',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'job_batch_manager';

    protected $casts = [
        'cancelled_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}
