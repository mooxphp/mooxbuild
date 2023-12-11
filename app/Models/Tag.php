<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'uid',
        'title',
        'slug',
        'content',
        'data',
        'image',
        'thumbnail',
        'weight',
        'model',
        'language_id',
        'translation_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'data' => 'array',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function hasTranslation()
    {
        return $this->hasOne(Tag::class, 'translation_id');
    }

    public function translation()
    {
        return $this->belongsTo(Tag::class, 'translation_id');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'taggable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    public function items()
    {
        return $this->morphedByMany(Item::class, 'taggable');
    }
}
