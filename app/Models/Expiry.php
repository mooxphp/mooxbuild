<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expiry extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'item',
        'link',
        'expired_at',
        'notified_at',
        'notified_to',
        'escalated_at',
        'escalated_to',
        'handled_by',
        'done_at',
        'expiry_monitor_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'expired_at' => 'datetime',
        'notified_at' => 'datetime',
        'escalated_at' => 'datetime',
        'done_at' => 'datetime',
    ];

    public function expiryMonitor()
    {
        return $this->belongsTo(ExpiryMonitor::class);
    }
}
