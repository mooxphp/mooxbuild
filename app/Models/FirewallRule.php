<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FirewallRule extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['rule', 'type', 'all_rule', 'ip_address'];

    protected $searchableFields = ['*'];

    protected $table = 'firewall_rules';

    protected $casts = [
        'all_rule' => 'boolean',
    ];
}
