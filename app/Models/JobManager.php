<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobManager extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'job_id',
        'name',
        'queue',
        'available_at',
        'started_at',
        'finished_at',
        'failed',
        'attempt',
        'progress',
        'exception_message',
        'status',
        'job_queue_worker_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'job_manager';

    protected $casts = [
        'available_at' => 'datetime',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'failed' => 'boolean',
    ];

    public function jobQueueWorker()
    {
        return $this->belongsTo(JobQueueWorker::class);
    }
}
