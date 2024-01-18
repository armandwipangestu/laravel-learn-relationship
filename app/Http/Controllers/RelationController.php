<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
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
}
