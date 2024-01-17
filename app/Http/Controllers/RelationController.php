<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $post = Post::with('comments')->where('id', $request->id)->first();
        return $post;
    }
}
