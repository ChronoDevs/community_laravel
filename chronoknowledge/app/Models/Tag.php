<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'plain_description',
        'html_description',
    ];

    /**
     * List all tags
     */
    public function scopeTagList($query)
    {
        return $query->latest()
            ->paginate(10);
    }

    /**
     * List all tags
     */
    public function scopeTags($query)
    {
        return $query->latest()
            ->get();
    }
}
