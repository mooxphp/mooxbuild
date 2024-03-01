<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WpTermRelationship extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['term_taxonomy_id', 'term_order'];

    protected $searchableFields = ['*'];

    protected $table = 'wp_term_relationships';
}
