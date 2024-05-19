<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
    public function following($id){
        // dd($id);
        Follow::create([
        'followed_id'=>$id,
        'following_id'=>Auth::id(),
    ]);

    return redirect('/top');

    }

}
