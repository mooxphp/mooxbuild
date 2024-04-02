<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['language_id', 'fallback_language_id'];

    protected $searchableFields = ['*'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function fallback_language()
    {
        return $this->belongsTo(Language::class, 'fallback_language_id');
    }

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'translatable');
    }
}
