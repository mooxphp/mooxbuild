<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'isocode',
        'flag',
        'active',
        'published',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'active' => 'boolean',
        'published' => 'boolean',
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
