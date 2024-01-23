<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Continent extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'slug', 'parent_continent_id'];

    protected $searchableFields = ['*'];

    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function parentContinent()
    {
        return $this->hasOne(Continent::class, 'parent_continent_id');
    }

    public function continent()
    {
        return $this->belongsTo(Continent::class, 'parent_continent_id');
    }
}
