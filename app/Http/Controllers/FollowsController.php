<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{

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
        //dd($userId);
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

    // フォローリスト
    public function followList()
    {
        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->following()->pluck('followed_id');

        $posts = Post::with('user')->whereIn('user_id' , $following_id)->get();
        $followeds_users=User::whereIn('id' , $following_id)->get();
        return view('/follows/followList' , compact('posts','followeds_users'));
    }

    // フォロワーリスト
    public function followerList()
    {
        // フォローされているユーザーのidを取得
        $following_id = Auth::user()->followed()->pluck('following_id');

        $posts = Post::with('user')->whereIn('user_id' , $following_id)->get();
        $followings_users=User::whereIn('id' , $following_id)->get();
        return view('/follows/followerList' , compact('posts','followings_users'));
    }

}
