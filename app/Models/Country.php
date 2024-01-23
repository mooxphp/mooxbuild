<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'continent_id',
        'delivery',
        'official',
        'native_name',
        'tld',
        'independent',
        'un_member',
        'status',
        'cca2',
        'ccn3',
        'cca3',
        'cioc',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'delivery' => 'boolean',
        'native_name' => 'array',
        'independent' => 'boolean',
        'un_member' => 'boolean',
    ];

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
