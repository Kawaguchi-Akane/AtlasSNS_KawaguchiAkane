<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follow;

class FollowsController extends Controller
{
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

    // フォロー解除
    public function unfollow($userId){
        $followed = auth()->user();
        $is_following = $followed->isFollowing($userId);

        if ($is_following) {
            $loggedInUserId = auth()->user()->id;
            Follow::where([
                ['followed_id','=',$userId],
                ['following_id','=',$loggedInUserId],
            ])->delete();
        }
        return back();
    }
    // フォロー
    public function following($userId){
        // dd($id);
        $followed = auth()->user();
        $is_following = $followed->isFollowing($userId);

        if (!$is_following){
            $loggedInUserId = auth()->user()->id;
            $followedUser = User::find($userId);
            $followedUserId = $followedUser->id;
        }
        Follow::create([
        'followed_id'=>$followedUserId,
        'following_id'=>$loggedInUserId,
    ]);
    // フォロー後の元の画面にリダイレクト
    return back();

    }

}
