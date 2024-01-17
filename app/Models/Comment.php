<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Now that we can access all of a post's comments, let's define a relationship to
    // allow a comment to access its parent post. To define the inverse of a hasMany
    // relationship, define a relationship method on the child model which calls the
    // belongsTo method:
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
