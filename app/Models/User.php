<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function oldestOrder(): HasOne
    {
        return $this->hasOne(Order::class, 'user_id', 'user_id')->oldestOfMany();
    }

    public function largestOrder(): HasOne
    {
        return $this->hasOne(Order::class, 'user_id', 'user_id')->ofMany('price', 'max');
    }
}
