<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seo extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'seoable_id',
        'seoable_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'twitter_site',
        'twitter_creator',
        'schema_markup',
        'breadcrumb_title',
        'canonical_url',
        'redirect_url',
        'focus_keyphrases',
        'focus_keyphrase',
        'seo_scores',
        'seo_score',
        'readability_score',
        'fav_icon',
        'app_icon',
        'app_color',
        'web_manifest',
        'noindex',
        'nofollow',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'schema_markup' => 'array',
        'focus_keyphrases' => 'array',
        'seo_scores' => 'array',
        'web_manifest' => 'array',
        'noindex' => 'boolean',
        'nofollow' => 'boolean',
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
