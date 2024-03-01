<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WpTermTaxonomy extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'term_id',
        'taxonomy',
        'description',
        'parent',
        'count',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'wp_term_taxonomy';
}
