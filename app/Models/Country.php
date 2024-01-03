<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['continent_id'];

    protected $searchableFields = ['*'];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    public function currencies()
    {
        return $this->belongsToMany(Currency::class);
    }

    public function timezones()
    {
        return $this->belongsToMany(Timezone::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }
}
