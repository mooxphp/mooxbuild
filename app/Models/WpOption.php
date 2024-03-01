<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WpOption extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['option_name', 'option_value', 'autoload'];

    protected $searchableFields = ['*'];

    protected $table = 'wp_options';
}
