<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WpComment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'comment_post_ID',
        'comment_author',
        'comment_author_email',
        'comment_author_url',
        'comment_author_IP',
        'comment_date',
        'comment_date_gmt',
        'comment_content',
        'comment_karma',
        'comment_approved',
        'comment_agent',
        'comment_type',
        'comment_parent',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'wp_comments';

    protected $casts = [
        'comment_date' => 'datetime',
        'comment_date_gmt' => 'datetime',
    ];
}
