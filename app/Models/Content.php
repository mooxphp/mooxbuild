<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'content_element_id',
        'title',
        'slug',
        'data',
        'settings',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'data' => 'array',
        'settings' => 'array',
    ];

    public function contentElement()
    {
        return $this->belongsTo(ContentElement::class);
    }

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'contentable');
    }
}
