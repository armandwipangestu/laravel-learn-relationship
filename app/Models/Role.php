<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Defining the Inverse of the Relationship
    // To define the "inverse" of a many-to-many relationship, you should define a
    // method on the related model which also returns the result of the `belongsToMany`
    // method. To complete our user / role example, let's define the `users` method on the
    // `Role` model:
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')->orderBy('name');
    }

    // As you can see, the relationship is defined exactly the same as its `User` model
    // counterpart with the exception of referencing the `App\Models\User` model. Since
    // we're reusing the `belongsToMany` method, all of the usual table and key
    // customization options are available when defining the "inverse" of many-to-many
    // relationships.
}
