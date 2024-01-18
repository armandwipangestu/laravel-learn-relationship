<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
