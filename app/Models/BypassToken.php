<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BypassToken extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['token', 'user_id'];

    protected $searchableFields = ['*'];

    protected $table = 'bypass_tokens';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
