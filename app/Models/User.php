<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'username', 'email'
    ];

    protected $primaryKey = 'user_id';

    // One to One Relationship
    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class, 'foreign_user_id', 'user_id');
    }

    // Sometimes a model may have many related models, yet you want to
    // easily retrieve the "latest" or "oldest" related model of the
    // relationship. For example, a `user` model may be related to many `order`
    // models. but you want to define a convenient way to interact with the most
    // recent order the user has placed. You may accomplish this using the `hasOne`
    // relationship type combined with the `ofMany` methods:
    public function latestOrder(): HasOne
    {
        return $this->hasOne(Order::class, 'user_id', 'user_id')->latestOfMany();
    }

    // Likewise, you may define a method to retrieve the "oldest", or first, related model of
    // a relationship:
    public function oldestOrder(): HasOne
    {
        return $this->hasOne(Order::class, 'user_id', 'user_id')->oldestOfMany();
    }

    // By default, the `latestOfMany` and `oldestOfMany` methods will retrieve the latest or
    // oldest related model based on the model's primary key, which must be sortable.
    // However, sometimes you may wish to retrieve a single model from a larger
    // relationship using a different sorting criteria.

    // For example, using the `ofMany` method, you may retrieve the user's most expensive
    // order. The `ofMany` method accepts the sortable column as its first argument and
    // which aggregate function (`min` or `max`) to apply when querying for the related
    // model:
    // public function largestOrder(): HasOne
    // {
    //     return $this->hasOne(Order::class, 'user_id', 'user_id')->ofMany('price', 'max');
    // }

    // Converting "Many" Relationship to Has One Relationships
    // Often, when retrieving a single model using the `latestOfMany`, `oldestOfMany`, or
    // `ofMany` methods, you already have a "has many" relationship defined for the same model.
    // For convenience, Laravel allows you to easily convert this relationship into a "has one"
    // relationship by invoking the `one` method on the relationship:
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    public function largestOrder(): HasOne
    {
        return $this->orders()->one()->ofMany('price', 'max');
    }

    // Many to Many Relationships
    // Many-to-many relations are slightly more complicated than `hasOne` and `hasMany`
    // relationships. An example of a many-to-many relationship is a user that has many
    // roles and those roles are also shared by other users in the application. For example,
    // a user may be assigned the role of "Author" and "Editor"; however, those roles may
    // also be assigned to other users as well. So, a user has many roles and a role has many
    // users.
    //
    // To define this relationship, three database tables are needed: `users`, `roles`, and
    // `role_user`. The `role_user` table is derived from the alphabetical order of the related
    // model names and contains `user_id` and `role_id` columns. This table is used as an
    // intermediate table linking the users and roles.
    //
    // Remember, since a role can belong to many users, we cannot simply place a `user_id`
    // column on the `roles` table. This would mean that a role could only belong to a single
    // user. In order to provide support for roles being assigned to multiple users, the `role_user`
    // table is needed. We can summerize the relationship's table structure like so:
    //
    // users
    //      id - integer
    //      name - string
    //
    // roles
    //      id - integer
    //      name - string
    //
    // role_user
    //      user_id - integer
    //      role_id - intger
    //
    // Many-to-many relationships are defined by writing a method that returns the result
    // of the `belongsToMany` method. The `belongsToMany` method is provided by the
    // `Illuminate\Database\Eloquent\Model` base class that is used by all of your application's
    // Eloquent models. For example, let's define a `roles` method on our `User` model. The
    // first argument passed to this method is the name of the related model class:
    public function roles(): BelongsToMany
    {
        // return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->orderBy('name');

        // `withPivot` method chaining is for extra attribute contains in intermediate table/model.
        // Because by default, only the model keys will be present on the `pivot` attribute/model.
        // in this case, default model will be return if not chaining method `withPivot` is:
        //
        // - user_id
        // - role_id
        //
        // So if you want to get extra attribute from intermediate table like `created_at` or `updated_at`
        // you need to passing argument on the method `withPivot`
        // return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->orderBy('name')->withPivot('created_at', 'updated_at');

        // Or you can simplify if you would like your intermediate table to have `created_at` and `updated_at`
        // timestamps that are automatically maintained by Eloquent, call the `withTimestamps` method
        // when defining the relationship
        //
        // You can customize of `pivot` attribute with method `as`
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->orderBy('name')->as('role_user')->withTimestamps();
    }

    public function podcasts(): BelongsToMany
    {
        return $this->belongsToMany(Podcast::class, 'podcast_user', 'user_id', 'podcast_id')->orderBy('name')->as('subscription')->withPivot('approved', 'priority')->withTimestamps();
    }
}
