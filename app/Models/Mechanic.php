<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Mechanic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Has One Through
    // The 'has-one-through' relationship defines a one-to-one relationship with another
    // model. However, this relationship indicates that the declaring model can be matched
    // with one instance of another model by proceeding through a third model.

    // For exampple, in a vehicle repair shop application, each `Mechanic` model may be
    // associated with one `Car` model, and each `Car` model may be associated with one `Owner`
    // model. While the mechanic can access the owner through the `Car` model. Let's look at
    // the tables necessary to define this relationship:
    //
    // - mechanics:
    //      id - integer
    //      name - string
    //
    // - cars:
    //      id - integer
    //      model - string
    //      mechanic_id - integer
    //
    // - owners:
    //      id - integer
    //      name - string
    //      car_id - integer
    //
    // Now that we have examined the table structure for the relationship, let's define the
    // relationship on the `Mechanic` model:

    public function carOwner(): HasOneThrough
    {
        return $this->hasOneThrough(Owner::class, Car::class, 'mechanic_id', 'car_id', 'id', 'id');
    }

    // The first argument passed to the `hasOneThrough` method is the name of the final model
    // we wish to access, while the second argument is the name of the intermediate model.
    //
    // Or, if the relevant relationships have already been defined on all of the models involved
    // in the relationship, you may fluently define a "has-one-through" relationship by invoking the
    // `through` method and supplying the names of those relationships. For example, if the `Mechanic`
    // model has a `cars` relationship and the `Car` model has an `owner` relationship, you may define a
    // "has-one-through" relationship connecting the mechanic and the owner like so:

    public function cars(): HasOne
    {
        return $this->hasOne(Car::class, 'mechanic_id', 'id');
    }

    // String based syntax
    public function owner()
    {
        return $this->through('cars')->has('owner');
    }

    // Dynamic syntax
    public function owner2()
    {
        return $this->throughCars()->hasOwner();
    }
}
