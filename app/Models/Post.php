<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $primaryKey = 'post_id';

    // a One to Many relationship is used to define relationships where a single model is the parent
    // to one or more child models. For example, a blog post may have an infinite number of comments.
    // Like all eloquent relationships, one-to-many relationships are defined by defining a method
    // on your eloquent model
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'foreign_post_id', 'post_id');
    }
}
