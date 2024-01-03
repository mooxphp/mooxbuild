<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
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
        'model',
        ' created_by_user_id',
        'created_by_user_name',
        'edited_by_user_id',
        'edited_by_user_name',
        'language_id',
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
        return $this->belongsTo(Category::class, 'translation_id');
    }

    public function hasTranslation()
    {
        return $this->hasOne(Category::class, 'translation_id');
    }

    public function mainCategoryPosts()
    {
        return $this->hasMany(Post::class, 'main_category_id');
    }

    public function mainCategoryItems()
    {
        return $this->hasMany(Item::class, 'main_category_id');
    }

    public function mainCategoryProducts()
    {
        return $this->hasMany(Product::class, 'main_category_id');
    }

    public function mainCategoryPages()
    {
        return $this->hasMany(Page::class, 'main_category_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categoryable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'categoryable');
    }

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'categoryable');
    }

    public function items()
    {
        return $this->morphedByMany(Item::class, 'categoryable');
    }
}
