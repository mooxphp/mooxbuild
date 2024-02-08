<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobQueueWorker extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'worker_pid',
        'queue',
        'worker_server',
        'supervisor',
        'status',
        'started_at',
        'stopped_at',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'job_queue_workers';

    protected $casts = [
        'started_at' => 'datetime',
        'stopped_at' => 'datetime',
    ];

    public function jobManagers()
    {
        return $this->hasMany(JobManager::class);
    }
}
