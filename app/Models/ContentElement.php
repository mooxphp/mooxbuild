<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentElement extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'data_structure',
        'template',
        'component',
        'theme_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'content_elements';

    protected $casts = [
        'data_structure' => 'array',
    ];

    public function content()
    {
        return $this->hasOne(Content::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
