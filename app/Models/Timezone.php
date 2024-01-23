<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timezone extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'zone_name',
        'country_code',
        'abbreviation',
        'time_start',
        'gmt_offset',
        'dst',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'dst' => 'boolean',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
