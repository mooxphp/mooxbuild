<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
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

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function hasTranslation()
    {
        return $this->hasOne(Post::class, 'translation_id');
    }

    public function translation()
    {
        return $this->belongsTo(Post::class, 'translation_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(Category::class, 'main_category_id');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    public function revisions()
    {
        return $this->morphToMany(Revision::class, 'revisionable');
    }
}
