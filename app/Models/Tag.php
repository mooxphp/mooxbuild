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
        'created_by_user_id',
        'created_by_user_name',
        'edited_by_user_id',
        'edited_by_user_name',
        'translation_id',
        'published_at',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'data' => 'array',
        'published_at' => 'datetime',
    ];

    public function hasTranslation()
    {
        return $this->hasOne(Tag::class, 'translation_id');
    }

    public function translation()
    {
        return $this->belongsTo(Tag::class, 'translation_id');
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
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
