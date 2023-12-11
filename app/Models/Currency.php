<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [];

    protected $searchableFields = ['*'];

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
