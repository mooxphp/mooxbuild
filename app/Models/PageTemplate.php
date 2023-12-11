<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageTemplate extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['page_id'];

    protected $searchableFields = ['*'];

    protected $table = 'page_templates';

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
