<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WpUserMeta extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'meta_key', 'meta_value'];

    protected $searchableFields = ['*'];

    protected $table = 'wp_usermeta';
}
