<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'theme_package',
        'themeable_id',
        'themeable_type',
    ];

    protected $searchableFields = ['*'];

    public function contentElements()
    {
        return $this->hasMany(ContentElement::class);
    }

    public function themeable()
    {
        return $this->morphTo();
    }
}
