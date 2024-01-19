<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Has Many Through
    // The "has-many-through" relationship provides a convenient way to access distant
    // relations via an intermediate relation. For example, let's assume we are building a
    // deployment platform like Laravel Vapor. A `Project` model might access many `Deployment`
    // models through an intermediate `Environment` model. Using this example, you could easily
    // gather all deployments for a given project. Let's look at the tables required to define this
    // relationship:
    //
    // projects
    //      id - integer
    //      name - string
    //
    // environments
    //      id - integer
    //      project_id - integer
    //      name - string
    //
    // deployments
    //      id - integer
    //      environment_id - integer
    //      commit_hash - string
    //
    // Now that we have examined the table structure for the relationship, let's define the
    // relationship on the `Project` model:

    public function deployments(): HasManyThrough
    {
        return $this->hasManyThrough(Deployment::class, Environment::class, 'project_id', 'environment_id', 'id', 'id');
    }

    // The first argument passwd to the `hasManyThrough` method is the name of the final model we wish
    // to access, while the second argument is the name of the intermediate model.
    //
    // Or, if the relevant relationships have already been defined on all off the models involved
    // in the relationship, you may fluently define a "has-many-through" relationship by invoking
    // the `through` method and supplying the names of those relationships. For example, if the `Project`
    // model has a `environments` relationship and the `Environment` model has a `deployments` relationship,
    // you may define a "has-many-through" relationship connecting the project and the deployments like so:

    public function environments(): HasMany
    {
        return $this->hasMany(Environment::class, 'project_id', 'id');
    }

    // String based syntax
    public function deployment()
    {
        return $this->through('environments')->has('deployments');
    }

    // Dynamic syntax
    public function deployment2()
    {
        return $this->throughEnvironments()->hasDeployments();
    }
}
