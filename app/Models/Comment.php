<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'translations',
        'parent_id',
        'author_id',
        'is_from_author',
        'name',
        'email',
        'avatar',
        'is_spam',
        'is_public',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'translations' => 'array',
        'is_from_author' => 'boolean',
        'is_spam' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function parent()
    {
        return $this->hasOne(Comment::class, 'parent_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'commentable');
    }

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'commentable');
    }
}
