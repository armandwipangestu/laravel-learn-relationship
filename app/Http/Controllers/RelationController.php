<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function oneToOne(Request $request)
    {
        $user = User::with('phone')->where('username', $request->username)->find(1);
        // $user2 = User::where('username', $request->username)->find(1);
        // $userPhone = $user2->phone;
        return $user;
    }
}
