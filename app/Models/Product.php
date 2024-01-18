<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    // Advanced Has One of Many Relationships
    // It is possible to construct more advanced "has one of many" relationships. For
    // example, a `Product` model may have many associated `Price` models that are
    // retained in the system even after enw pricing is published. In addition, new pricing
    // data for the product may be able to be published in advance to take effect at a future
    // date via a `published_at` column.

    // So, in summay, we need to retrieve the latest published pricing where the published
    // date is not in the future. In addition, if two prices have the same
    // published date, we will prefer the price with the greatest ID. To accomplish this, we
    // must pass an array to the `ofMany` method that contains the sortable columns which
    // determine the latest price. In addition, a clousre will be provided as the second argument
    // to the `ofMany` method. This closure will be responsible for adding additional publish date
    // constraints to the relationship query:
    public function currentPricing(): HasOne
    {
        return $this->hasOne(Price::class)->ofMany([
            'published_at' => 'max',
            'id' => 'max',
        ], function (Builder $query) {
            $query->where('published_at', '<', now());
        });
    }
}
