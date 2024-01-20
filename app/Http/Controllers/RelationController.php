<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Project;
use App\Models\Mechanic;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function test(Request $request)
    {
        $user = User::find($request->id);
        $data = [];

        foreach ($user->roles as $role) {
            $data[] = $role->pivot;
        }

        return $data;
    }

    public function oneToOne(Request $request)
    {
        $user = User::with('phone')->where('username', $request->username)->first();
        // $user2 = User::where('username', $request->username)->find(1);
        // $userPhone = $user2->phone;
        return $user;
    }

    public function oneToMany(Request $request)
    {
        $post = Post::with('comments')->where('post_id', $request->id)->first();
        return $post;
    }

    public function defaultModel(Request $request)
    {
        $post = Post::find($request->number);
        return $post->user;
    }

    public function whereBelongsTo(Request $request)
    {
        // when querying for the children of "belongs to" relationship, you may manually
        // build the `where` clause to retrieve the corresponding Eloquent models:
        $user = User::where('user_id', $request->id)->first();
        // $posts = Post::where('user_id', $user->user_id)->get();
        // return $posts;

        // However, you may find it more convenient to use the `whereBelongsTo` method, which
        // will automatically determine the proper relationship and foreign key for the given model:
        // $posts = Post::whereBelongsTo($user)->get();
        // return $posts;

        // You may also provide a collection instace to the `whereBelongsTo` method. When
        // doing so, Laravel will retrieve models that belong to any of the parent models
        // within the collection
        // $users = User::where('vip', true)->get();
        // $posts = Post::whereBelongsTo($users)->get();

        // By default, Laravel will determine the relationship associated with the given model
        // based on the class name of the model. For example: the instance pass to the argument
        // `whereBelongsTo` is `$user`, so it will be use relationship from model `Post` with 
        // method name `user()`; however, you may specify the relationship name manually by
        // providing it as the second argument to the `whereBelongsTo` method:
        $posts = Post::whereBelongsTo($user, 'author')->get();
        return $posts;
    }

    public function hasOneOfMany(Request $request)
    {
        $user = User::find($request->id);
        $summary = [];
        $summary['latestOrder'] = $user->latestOrder;
        $summary['oldestOrder'] = $user->oldestOrder;
        $summary['largestOrder'] = $user->largestOrder;

        return $summary;
    }

    public function advanceHasOneOfMany(Request $request)
    {
        $product = Product::with('currentPricing')->find($request->id);
        return $product;
    }

    public function hasOneThrough(Request $request)
    {
        $mechanic = Mechanic::with('carOwner')->find($request->id);
        return $mechanic;
    }

    public function hasManyThrough(Request $request)
    {
        $project = Project::with(['environments', 'deployments'])->find($request->id);
        return $project;
    }

    public function belongsToMany(Request $request)
    {
        $user = User::find($request->id)->with('roles')->orderBy('name')->get();
        return $user;
    }

    public function inversBelongsToMany(Request $request)
    {
        $role = Role::find($request->id)->with('users')->get();
        return $role;
    }

    // Retrieving Intermediate Table Columns
    // As you have already learned, working with many-to-many relations requires the
    // presence of an intermediate table. Eloquent provides some very helpful ways of
    // interacting with this table. For example, let's assume our `User` model has many
    // `Role` models that is related to. After accessing this relationship, we may access
    // the intermediate table using the `pivot` attribute on the models:
    public function retrievingIntermediateModel(Request $request)
    {
        $user = User::find($request->id);
        $data = [];

        foreach ($user->roles as $role) {
            $data[] = $role->role_user;
        }

        return $data;
    }

    public function customizingPivotAttributeName(Request $request)
    {
        $users = User::with('podcasts')->get();
        // dd($users);
        $data = [];

        foreach ($users->flatMap->podcasts as $podcast) {
            $data[] = $podcast->subscription;
        }

        return $data;
    }
}
