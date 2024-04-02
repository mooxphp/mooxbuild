<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpiryMonitor extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'runs',
        'monitors',
        'executes',
        'notifies',
        'escalates',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'expiry_monitors';

    public function expiries()
    {
        return $this->hasMany(Expiry::class);
    }
}
