<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    // Default Models
    // The `belongsTo`, `hasOne`, `hasOneThrough`, and `morphOne` relationship allow you to define
    // a default model that will be returned if the given relationship is `null`. This pattern is
    // often refered to as the Null Object pattern and can help remove conditional
    // checks in your code. In the following example, the `user` relation will return an
    // empty `App\Models\User` model if no user is attached to the `Post` model:
    //
    // To populate the default model with attributes, you may pass an array or closure to the
    // `withDefault` method:
    //
    // - Pass an array
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'user_id')->withDefault([
    //         'name' => 'Guest Author'
    //     ]);
    // }
    //
    // - Pass an Closure
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id')->withDefault(function (User $user, Post $post) {
            $user->name = 'Guest Author';
        });
    }
}
