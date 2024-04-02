<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'uid',
        'main_category_id',
        'title',
        'slug',
        'short',
        'content',
        'data',
        'image',
        'thumbnail',
        'author_id',
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

    public function translation()
    {
        return $this->belongsTo(Item::class, 'translation_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(Category::class, 'main_category_id');
    }

    public function hasTranslations()
    {
        return $this->hasMany(Item::class, 'translation_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function revisions()
    {
        return $this->morphToMany(Revision::class, 'revisionable');
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
