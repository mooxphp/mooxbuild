<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Revision extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'revname',
        'revcomment',
        'revretention',
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
        'categories',
        'tags',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'revretention' => 'datetime',
        'data' => 'array',
        'categories' => 'array',
        'tags' => 'array',
    ];

    public function items()
    {
        return $this->morphedByMany(Item::class, 'revisionable');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'revisionable');
    }
}
